<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AuthItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '角色列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'label' => '类型',
                'attribute'=>'updated_at',
                'value' => function($data) {
                    return ($data->type == 1) ? '角色' : '权限';
                }
            ],
            'description:ntext',
            [
                'label' => '规则名称',
                'attribute'=>'rule_name',
            ],
            [
                'label' => '数据',
                'attribute'=>'data',
            ],
            [
                'label' => '创建时间',
                'attribute'=>'created_at',
                'value' => function($data) {
                    return date('Y-m-d H:i:s',$data->created_at);
                }
            ],
            [
                'label' => '修改时间',
                'attribute'=>'updated_at',
                'value' => function($data) {
                    return date('Y-m-d H:i:s',$data->updated_at);
                }
            ],
        ],
    ]) ?>

</div>
