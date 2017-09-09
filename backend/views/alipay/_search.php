<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AlipaySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manager-search">

    <?php $form = ActiveForm::begin([
        'action' =>  'index',
        'method' => 'get',
        'options' => ['class'=>'form-inline'],
    ]); ?>

    <?php if(Yii::$app->params['timeSwith']){?>
    <div class="row">
        <div class="col-lg-8"></div>
        <div class="col-lg-4">
            <p class="text-right">
                <?= Html::a('编辑预警搜索信息', ['add'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('一键搜索', ['one-search'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('导入预警信息', ['create'], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
    </div>
<?php }?>
    <div class="row">

        <div class="col-lg-6">
            <?php if(Yii::$app->params['timeSwith']){?>
            <div class="text-left no-padding">

                <div class="form-group">
                    <?php    echo DateTimePicker::widget([
                        'name' => 'AlipaySearch[begin_time]',
                        'options' => ['placeholder' => ''],
                        //注意，该方法更新的时候你需要指定value值
                        'value' => $model->begin_time,
                        'id'=>'alipaysearch-begin_time',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'm/dd/yy h:ii',
                            'todayHighlight' => true
                        ]
                    ]);
                    ?>
                    至
                    <?php    echo DateTimePicker::widget([
                        'name' => 'AlipaySearch[end_time]',
                        'options' => ['placeholder' => ''],
                        //注意，该方法更新的时候你需要指定value值
                        'value' => $model->end_time,
                        'id'=>'alipaysearch-end_time',
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'm/dd/yy h:ii',
                            'todayHighlight' => true
                        ]
                    ]);
                    ?>
                </div>
            </div>
            </div>
                <?= $form->field($model, 'search_keywords')->textInput()->label() ?>
                <div class="form-group">

                    <?= Html::submitButton('搜索', ['class' => 'btn btn-primary m-t-n-xs','id'=>'search']) ?>
                </div>
            </div>
        <?php }else{?>

            <?= $form->field($model, 'search_keywords')->textInput()->label() ?>
            <div class="form-group">

                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary m-t-n-xs','id'=>'search']) ?>
            </div>
            </div>
            <div class="col-lg-6">
                <p class="text-right">
                    <?= Html::a('编辑预警搜索信息', ['add'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('一键搜索', ['one-search'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('导入预警信息', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
    <?php }?>
        </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
