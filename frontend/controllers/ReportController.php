<?php

namespace frontend\controllers;

use common\models\Event;
use common\models\ReportPhoto;
use Yii;
use common\models\Report;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        ];
    }

    /**
     * Displays a single Report model.
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
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($event_id = null)
    {
        $model = new Report();
        $model->event_id = $event_id;

        $eventModel = Event::find($event_id)->one();

        if ($model->load(Yii::$app->request->post())) {
            $this->saveImages($model);
            $model->save();
            if ($model->save()) {
                \Yii::$app->getSession()->setFlash('success', 'Отчет успешно отправлен на модерацию');
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
            Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/report/';
            $reportPhoto->photo = Yii::$app->security->generateRandomString() . '.' . $image->extension;
            $path = Yii::$app->params['uploadPath'] .  $reportPhoto->photo;
            $reportPhoto->save();
            $image->saveAs($path);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
