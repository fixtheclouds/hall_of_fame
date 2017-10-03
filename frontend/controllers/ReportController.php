<?php

namespace frontend\controllers;

use common\models\Event;
use common\models\ReportPhoto;
use Yii;
use common\models\Report;
use yii\data\ActiveDataProvider;
use yii\db\BaseActiveRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
{
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
                        'actions' => ['create', 'update', 'own', 'view', 'delete'],
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
     * Displays a single Report model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if ($model->status == 'pending' && !$model->isMine()) {
            $this->redirect(['/account']);
        }

        if ($model->deleted_at != null) {
            throw new NotFoundHttpException('Страница не существует.');
        }

        $eventModel = $model->getEvent()->one();
        return $this->render('view', [
            'model' => $model,
            'eventModel' => $eventModel
        ]);
    }

    /**
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($event_id = null)
    {
        $model = new Report();
        $model->scenario = 'create';
        $model->event_id = $event_id;
        $eventModel = $model->getEvent()->one();

        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->user->identity->isAdmin) {
                $model->status = 'published';
                $message = 'Отчет успешно опубликован';
            } else {
                $message = 'Отчет успешно отправлен на модерацию';
            }
            if ($model->save()) {
                $this->saveImages($model);
                \Yii::$app->getSession()->setFlash('success', $message);
                return $this->redirect(['event/view', 'id' => $model->event_id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'eventModel' => $eventModel
        ]);
    }

    /**
     * @param $model
     */
    private function saveImages($model) {
        $images = UploadedFile::getInstances($model, 'images');
        foreach ($images as $image) {
            $reportPhoto = new ReportPhoto();
            $reportPhoto->report_id = $model->id;
            $reportPhoto->photo = Yii::$app->security->generateRandomString() . '.' . $image->extension;
            $reportPhoto->save();
            $image->saveAs(UPLOAD_PATH . $reportPhoto->photo);
        }
    }

    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->status == 'published' || !$model->isMine()) {
            $this->redirect(['/account']);
        }
        $model->scenario = 'update';
        $eventModel = $model->getEvent()->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'eventModel' => $eventModel
            ]);
        }
    }

    /**
     * @return string
     */
    public function actionOwn()
    {
        $this->layout = 'authorized';
        return $this->render('index', [
            'pageTitle' => 'Мои отчеты',
            'dataProvider' => new ActiveDataProvider([
                'query' => Report::find()->byUserId(Yii::$app->user->id),
                'pagination' => [
                    'pageSize' => 5
                ]
            ])
        ]);
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!$model->isMine() || (!Yii::$app->user->identity->isAdmin && $model->status == 'published')) {
            $this->redirect(['/account']);
        }

        $model->updateAttributes(['deleted_at' => time()]);
        foreach ($model->reportPhotos as $photo) {
            $photo->delete();
        }
        return $this->redirect(['/account']);
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
