<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Invest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '协查信息列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invest-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'instance_number',
            'system_number',
            'instance_name',
            'filing_unit',
            'filing_province',
            'instance_detail:ntext',
            'case_person',
            'phone',
            'filing_time',
            [
                'attribute' => 'add_time',
                'format'=>['date', 'php:Y-m-d H:i:s'],
            ],
            [
                'attribute' => 'update_time',
                'format'=>['date', 'php:Y-m-d H:i:s'],
            ],
        ],
    ]) ?>

</div>
