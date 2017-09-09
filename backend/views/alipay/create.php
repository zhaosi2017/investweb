<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = '导入文件';
$this->params['breadcrumbs'][] = ['label' => '支付宝预警', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <div class="row">

        <?php $form = ActiveForm::begin([
                'options' => ['enctype' => 'multipart/form-data'],
                'fieldConfig' => [
                    'template' => "{label}\n<div class=\"col-sm-3\">{input}\n<span class=\"help-block m-b-none\">{error}</span></div><div class=\"col-sm-12\"></div>",
                    'labelOptions' => ['class' => 'col-sm-1 ','style'=>['width'=>'100px']],
                ],

        ]) ?>

        <?= $form->field($model, 'file')->fileInput() ?>
        <div class="col-sm-12" style="height: 40px !important; "></div>
        <div class="form-group">
            <div class="col-sm-1"></div>
            <button class="col-sm-3 btn btn-primary" >导入</button>

        </div>


        <?php ActiveForm::end() ?>
    </div>
</div>


