<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AuthItem */

$this->title = '新增权限';
$this->params['breadcrumbs'][] = ['label' => '权限列表', 'url' => ['privilege']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <?= $this->render('_privilegeform', [
        'model' => $model,
    ]) ?>

</div>
