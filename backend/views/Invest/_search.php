<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\InvestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'instance_number') ?>

    <?= $form->field($model, 'system_number') ?>

    <?= $form->field($model, 'instance_name') ?>

    <?= $form->field($model, 'filing_unit') ?>

    <?php // echo $form->field($model, 'filing_province') ?>

    <?php // echo $form->field($model, 'instance_detail') ?>

    <?php // echo $form->field($model, 'case_person') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'filing_time') ?>

    <?php // echo $form->field($model, 'add_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
