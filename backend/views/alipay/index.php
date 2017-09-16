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
        'rowOptions' => function($model, $key, $index, $grid) {
            return ['class' => $index % 2 == 0 ? 'label-red' : 'label-green'];
        },
        'pager'=>[
            //'options'=>['class'=>'hidden']//关闭自带分页
            'firstPageLabel'=>"首页",
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            'lastPageLabel'=>'末页',
            'maxButtonCount' => 9,
        ],
        'columns' => [
            [
                // 'class' => 'yii\grid\SerialColumn',
                'attribute' => 'id',
                'label' => '序号',
                'headerOptions' => ['width' => '50', 'align' => 'center'],
            ],
            [
                'attribute' => 'systime',
                'headerOptions' => ['width' => '100', 'align' => 'center'],
            ],
            [
                'attribute' => 'title',
                'headerOptions' => ['width' => '100', 'align' => 'center'],
                'enableSorting' => false
            ],
            [
                'attribute' => 'detail',
                'headerOptions' => ['width' => '100', 'align' => 'center'],
                'enableSorting' => false
            ],
            [
                'format'=>'html',
                'attribute' => 'account',
                'enableSorting' => false,
                'headerOptions' => ['align' => 'center'],
                'value' => function ($model) use($searchModel) {
                        $search_keywords = trim($searchModel->search_keywords);
                        return str_replace($search_keywords, "<span style='font-weight:bold;color:red'>".$search_keywords."</span>", $model->account);

                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['width' => '50', 'align' => 'center'],
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

    <script>
        var tTD; //用来存储当前更改宽度的Table Cell,避免快速移动鼠标的问题
        var table = document.getElementsByTagName("table")[0];
        for (j = 0; j < table.rows[0].cells.length; j++) {
            table.rows[0].cells[j].onmousedown = function () {
                //记录单元格
                tTD = this;
                if (event.offsetX > tTD.offsetWidth - 10) {
                    tTD.mouseDown = true;
                    tTD.oldX = event.x;
                    tTD.oldWidth = tTD.offsetWidth;
                }
            };
            table.rows[0].cells[j].onmouseup = function () {
                //结束宽度调整
                if (tTD == undefined) tTD = this;
                tTD.mouseDown = false;
                tTD.style.cursor = 'default';
            };
            table.rows[0].cells[j].onmousemove = function () {
                //更改鼠标样式
                if (event.offsetX > this.offsetWidth - 10)
                    this.style.cursor = 'col-resize';
                else
                    this.style.cursor = 'default';
                //取出暂存的Table Cell
                if (tTD == undefined) tTD = this;
                //调整宽度
                if (tTD.mouseDown != null && tTD.mouseDown == true) {
                    tTD.style.cursor = 'default';
                    if (tTD.oldWidth + (event.x - tTD.oldX)>0)
                        tTD.width = tTD.oldWidth + (event.x - tTD.oldX);
                    //调整列宽
                    tTD.style.width = tTD.width;
                    tTD.style.cursor = 'col-resize';
                    //调整该列中的每个Cell
                    table = tTD; while (table.tagName != 'TABLE') table = table.parentElement;
                    for (j = 0; j < table.rows.length; j++) {
                        table.rows[j].cells[tTD.cellIndex].width = tTD.width;
                    }
                }
            };
        }
    </script>
    <?php Pjax::end(); ?>

</div>

