<?php

namespace frontend\controllers;

use Yii;
use common\models\Feedback;
use common\models\FeedbackSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends Controller
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
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feedback();

        if (!\Yii::$app->user->isGuest) {
            $model->email = \Yii::$app->user->identity->email;
            $model->name = \Yii::$app->user->identity->profile->name;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Сообщение успешно отправлено.');
            return $this->redirect(['/']);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
