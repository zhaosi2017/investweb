<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\InvestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '协查信息列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invest-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            /*
            [
                'header' => '序号',
                'class' => 'yii\grid\SerialColumn'
            ],
            */
            'id',
            'instance_number',
            'system_number',
            'instance_name',
            'filing_unit',
            'filing_province',
            'instance_detail:ntext',
            'case_person',
            'phone',
            [
                'attribute' => 'filing_time',
                'format'=>['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'add_time',
                'format'=>['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'header' => '操作',
            ],
        ],
    ]); ?>
</div>
