<?php

namespace app\controllers;

use app\models\Transactions;
use app\models\TransactionsSearch;
use app\models\User;
use app\models\UsersSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','acount'],
                'rules' => [
                    [
                        'actions' => ['logout','acount'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider=UsersSearch::search();
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $user = User::find()->where(['nik' => $model->nik])->one();
            if(!$user) {
                $model->save();
                $transfer = new Transactions();
                $transfer->send_to = $model->id;
                $transfer->send_from = Yii::$app->user->id;
                $transfer->sum = $model->balance;

                if ($transfer->save(false)) {
                    return $this->goBack();
                }
            }
        }
        return $this->render('index',['dataProvider'=>$dataProvider,'model'=>$model]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays profile page.
     *
     * @return string
     */
    public function actionAcount()
    {
        $search=new TransactionsSearch();
        $dataProvider=$search->search(['send_from'=>Yii::$app->user->id]);
        return $this->render('profile',['dataProvider'=>$dataProvider]);
    }
}
