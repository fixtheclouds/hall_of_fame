<?php

namespace frontend\controllers;

use Yii;
use common\models\Event;
use common\models\EventSearch;
use common\models\Subtype;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller
{

    public $layout = 'authorized';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'index', 'own', 'actual', 'applied', 'archived', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['publish', 'dismiss'],
                        'allow' => true,
                        'roles' => ['admin']
                    ]

                ],
            ],
        ];
    }

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'pageTitle' => 'Мероприятия',
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists actual events
     * @return string
     */
    public function actionActual()
    {
        $dataProvider = Event::find()->published()->active();

        return $this->render('index', [
            'pageTitle' => 'Мероприятия',
            'dataProvider' => new ActiveDataProvider([
                'query' => $dataProvider
            ])
        ]);
    }

    /**
     * Lists archived events
     * @return string
     */
    public function actionArchived() {
        $dataProvider = Event::find()->published()->active(false);

        return $this->render('index', [
            'pageTitle' => 'Завершенные мероприятия',
            'dataProvider' => new ActiveDataProvider([
                'query' => $dataProvider
            ])
        ]);
    }

    /**
     * Lists user`s own events
     * @return string
     */
    public function actionOwn() {
        $dataProvider = Event::find()->published()->byUserId(Yii::$app->user->id);

        return $this->render('index', [
            'pageTitle' => 'Мероприятия, которые я запланировал',
            'dataProvider' => new ActiveDataProvider([
                'query' => $dataProvider
            ])
        ]);
    }

    /**
     * Lists events user had applied to
     * @return string
     */
    public function actionApplied() {
        $dataProvider = Event::find()->published()->withReportFromUser(Yii::$app->user->id);

        return $this->render('index', [
            'pageTitle' => 'Мероприятия, в которых я учавствую',
            'dataProvider' => new ActiveDataProvider([
                'query' => $dataProvider
            ])
        ]);
    }

    /**
     * Count events user has applied to
     * @return int
     */
    public function getAppliedCount() {
        return Event::find()->published()->withReportFromUser(Yii::$app->user->id)->count();
    }

    /**
     * Count events user has created
     * @return int
     */
    public function getOwnCount() {
        return Event::find()->published()->byUserId(Yii::$app->user->id)->count();
    }

    /**
     * Count non-actual events
     * @return int
     */
    public function getArchivedCount() {
        return Event::find()->published()->active(false)->count();
    }

    /**
     * Displays a single Event model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Event();

        if ($model->load(Yii::$app->request->post())) {
            $this->saveImage($model);
            if (Yii::$app->user->identity->isAdmin) {
                $model->status = 'published';
                $message = 'Мероприятие успешно опубликовано';
            } else {
                $message = 'Мероприятие отправлено на модерацию';
            }
            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', $message);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->saveImage($model);
            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Данные мероприятия успешно обновлены');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function saveImage($model) {
        $image = UploadedFile::getInstance($model, 'image');
        if ($image) {
            $names = explode(".", $image->name);
            $ext = end($names);
            $model->photo = Yii::$app->security->generateRandomString() . ".{$ext}";
            Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/event/';
            $path = Yii::$app->params['uploadPath'] . $model->photo;
            $image->saveAs($path);
        }
    }

    /**
     * Deletes an existing Event model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->updateAttributes(['deleted_at' => time()]);
        return $this->redirect(['index']);
    }

    /**
     * Опубликовать мероприятие
     * @param $id
     * @param $reverse
     * @return \yii\web\Response
     */
    public function actionPublish($id, $reverse = false) {
        $newStatus = $reverse ? 'pending' : 'published';
        $model = $this->findModel($id);
        $model->updateAttributes(['status' => $newStatus]);
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Отклонить мероприятие
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDismiss($id) {
        $model = $this->findModel($id);
        $model->updateAttributes(['status' => 'dismissed']);
        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Event::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
