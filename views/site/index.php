<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title = 'Task';
?>
<div class="col-lg-12">
    <?php if (Yii::$app->session->hasFlash('errors')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('errors') ?>
        </div>
    <?php endif; ?>
</div>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'layout'=>"{summary}\n{items}\n{pager}",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'nik',
        'balance',
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'template' => '{update}',
            'visible' => !Yii::$app->user->isGuest,
            'buttons' => [
                'update' => function ($url,$model) {
                    if($model->id !== Yii::$app->user->id){
                        return '
                            <form action="'.Yii::$app->urlManager->createUrl('transactions/create').'" method="post" class="transaction-form">
                                <input type="hidden" name="'.Yii::$app->request->csrfParam.'" value="'.Yii::$app->request->csrfToken.'">
                                <input type="hidden" value="'.Yii::$app->user->id.'" name="Transactions[send_from]">
                                <input type="hidden" value="'.$model->id.'" name="Transactions[send_to]">
                                <input type="text" name="Transactions[sum]">
                                <input type="submit" class="btn btn-success" value="Transfer"> 
                            </form>
                                ';
                    }else{
                        return '<span>My Balance</span>';
                    }
                }
            ],
        ],
    ],
]); ?>
<?php if(!Yii::$app->user->isGuest):?>
<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]); ?>
<?= $form->field($model, 'nik')->textInput(['autofocus' => true]) ?>
<?= $form->field($model, 'balance')->textInput(['autofocus' => true]) ?>
<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Transfer to new user', ['class' => 'btn btn-primary', 'name' => 'transfer-button']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

<?php endif;?>