<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Invest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invest-form">

    <?php $form = ActiveForm::begin([
        'options'=>[
            'enctype'=>'multipart/form-data',
            'class' => 'form-horizontal a-boxWidth2 form-ajax',
        ],
        'fieldConfig' => [
            'template' => "<label class='col-sm-1 control-label'>{label}:</label><div class='col-sm-6'>{input}<div class='help-block'>{error}</div></div>",
        ]
    ]); ?>

    <?= $form->field($model, 'instance_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'system_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instance_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'filing_time')->widget(DateTimePicker::classname(),
        [
            'options' => ['placeholder' => '', 'readonly' => true, 'size'=>16],
            'pluginOptions' => [
                'autoclose' => true,
                // 修改时候，展示用.
                // 'value' => $model->filing_time,
                'todayHighlight' => true,
                'todayBtn' => true,
                'format' => 'yyyy-mm-dd hh:ii:ss',
                'minView' => 2,
                'language' => 'en',
                // 位置.
                // 'pickerPosition' => 'bottom-right',
            ],
        ]
    ) ?>
    <?= $form->field($model, 'filing_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filing_province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instance_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'case_person')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'charge_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '新增' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
