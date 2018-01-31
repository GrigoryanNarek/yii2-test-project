<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Acount';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'label' => 'Nik',

            'value' => function ($model) {
                return \app\models\User::findOne($model->send_to)->nik;
            }
        ],
        'sum',

        [
            'label' => 'Date',

            'value' => function ($model) {
                return date('Y-m-d H:i:s',$model->created_at);
            }
        ]
    ],
]); ?>
