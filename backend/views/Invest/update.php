<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Invest */

$this->title = '更新协查信息: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '协查信息列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invest-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
