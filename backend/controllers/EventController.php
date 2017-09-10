<?php

namespace backend\controllers;

use Yii;
use common\models\Event;
use common\models\EventSearch;
use yii\web\NotFoundHttpException;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends BackendController
{

    /**
     * Lists all Event models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
     * Updates an existing Event model.
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
     * Deletes an existing Event model.
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

    /**
     * Опубликовать мероприятие
     * @param $id
     * @param $reverse
     * @return \yii\web\Response
     */
    public function actionPublish($id, $reverse = false) {
        $newStatus = $reverse ? 'pending' : 'published';
        $model = $this->findModel($id);
        $model->status = $newStatus;
        if (!$model->save()) {
            \Yii::$app->getSession()->setFlash('error', 'Возникла ошибка при обновлении записи');
        }
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
}
