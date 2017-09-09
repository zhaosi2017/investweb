<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '添加搜索预警信息';
$this->params['breadcrumbs'][] = ['label' => '支付宝预警', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div>

    <div class="row">
        <?php $form = ActiveForm::begin([

            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-sm-3\">{input}\n<span class=\"help-block m-b-none\">{error}</span></div><div class=\"col-sm-12\"></div>",
                'labelOptions' => ['class' => 'col-sm-1 ','style'=>[]],
            ],

        ]) ?>


        <div class="form-group">
            <div class="col-sm-1"></div>
            <span style="color: red;font-size: larger;">添加的预警信息格式如：34534534,56546456,67686</span>

        </div>
        <div class="col-sm-12" style="height: 40px !important; "></div>
        <?= $form->field($model, 'title')->textarea(['style'=>'height:130px;'])->label() ?>

        <div class="col-sm-12" style="height: 40px !important; "></div>
        <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
            <button class="btn btn-primary" style="width: 100%;">编辑</button>
            </div>
        </div>


        <?php ActiveForm::end() ?>
    </div>
</div>
