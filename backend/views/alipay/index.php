<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ManagerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '支付宝预警';
$this->params['breadcrumbs'][] = $this->title;
$actionId = Yii::$app->requestedAction->id;
//$updateSwitch = isset(Yii::$app->params['updateSwitch'])? Yii::$app->params['updateSwitch']:0;
?>
<div class="manager-index">

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n  <div><ul class='pagination'><li style='display:inline;'><span>共".$dataProvider->getTotalCount(). "条数据 <span></li></ul>{pager}  </div>",
        'pager'=>[
            //'options'=>['class'=>'hidden']//关闭自带分页
            'firstPageLabel'=>"首页",
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            'lastPageLabel'=>'末页',
            'maxButtonCount' => 9,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','header' => '序号'],
            'systime',
            'title:ntext',
            'detail:ntext',
            [
                'format'=>'html',
                'attribute' => 'account',
                'value' => function ($model) use($searchModel) {
                        $search_keywords = trim($searchModel->search_keywords);
                        return str_replace($search_keywords, "<span style='font-weight:bold;color:red'>".$search_keywords."</span>", $model->account);

                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update}',
                'buttons' => [
                    'update' => function($url){
                            return Html::a('编辑', $url);
                    },
                ],
                'visible'=>isset(Yii::$app->params['updateSwitch']) &&  Yii::$app->params['updateSwitch'] ? 1 : 0,
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
