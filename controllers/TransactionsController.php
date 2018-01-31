<?php

namespace app\controllers;

use Yii;
use app\models\Transactions;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\User;

/**
 * TransactionsController implements the CRUD actions for Transactions model.
 */
class TransactionsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionCreate()
    {
        $model = new Transactions();
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->trannsfer()) {
                return $this->goBack();
        } else {
            $errores = $model->getFirstError('sum');
            Yii::$app->session->setFlash('errors', $errores);
            return $this->goBack();
        }
    }
}
