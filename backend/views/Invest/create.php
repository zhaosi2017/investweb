<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Invest */

$this->title = '新增协查信息';
$this->params['breadcrumbs'][] = ['label' => '协查信息列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invest-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
