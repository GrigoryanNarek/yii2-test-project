<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$form = ActiveForm::begin([
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-6\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label'],
    ],
]);
?>
<?= $form->field($model, 'send_from')->hiddenInput(['value'=>Yii::$app->user->id]) ?>
<?= $form->field($model, 'send_to')->hiddenInput(['value'=>$model->id]) ?>
<?= $form->field($model, 'sum')->textInput() ?>
    <div class="form-group">
        <div class="col-xs-12">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary ml15', 'name' => 'add-button']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>