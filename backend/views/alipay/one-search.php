<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\LinkPager;
use yii\helpers\Url;
$this->title = '一健搜索';
$this->params['breadcrumbs'][] = ['label' => '支付宝预警', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$updateSwitch = isset(Yii::$app->params['updateSwitch'])? Yii::$app->params['updateSwitch']:0;
?>
<?php if(isset(Yii::$app->params['oneKeyOut']) && Yii::$app->params['oneKeyOut']){?>
<div>
    <?= Html::a('一键导出', ['one-out'], ['class' => 'btn btn-primary']) ?>
</div>
<?php }?>
<div>

<table class="table table-striped table-bordered" id="tb">
    <thead>
        <tr>
            <th>序号</th>
            <th>系统日期</th>
            <th>名例名称</th>
            <th>名例详情</th>
            <th>调取账户</th>
            <?php if($updateSwitch){?>
            <th>操作</th>
            <?php }?>

        </tr>
    </thead>
    <tbody>
        <?php if(empty($model)){?>
            <div>没有数据</div>
        <?php }else{?>
            <?php foreach ($model as $k=>$v){?>
                <tr>
                    <td><?= $v->id?></td>
                    <td><?= $v->systime?></td>
                    <td><?= $v->title?></td>
                    <td><?= $v->detail?></td>
                    <td>
                        <?php

                        $pos = strpos($search_keywords, ',');
                        if ($pos === false) {
                            $search_keywords = trim($search_keywords);
                            $html = str_replace($search_keywords, "<span style='font-weight:bold;color:red'>".$search_keywords."</span>", $v->account);
                        } else {
                            $keywordsArr = explode(',', $search_keywords);
                            $html = $v->account;
                            foreach ($keywordsArr as $key => $value) {
                                $search_keywords = trim($value);
                                $html = str_replace($search_keywords, "<span style='font-weight:bold;color:red'>".$search_keywords."</span>", $html);
                            }
                        }

                        echo $html;
                        ?>
                    </td>
                    <?php if($updateSwitch){?>
                        <td><a href="<?php echo Url::to(['alipay/update','id'=>$v->id])?>">编辑</a></td>
                    <?php }?>
                </tr>
                <?php }?>
        <?php }?>

    </tbody>

</table>
    <div class="row">
        <div class="col-sm-2" style="margin: 20px 0;">总共有 <?php echo $pages->totalCount;?> 条记录</div>
        <div class="col-sm-9">
        <?php echo LinkPager::widget([
            'pagination' => $pages,

        ]);?>
        </div>
    </div>
</div>

<script>
var tTD; //用来存储当前更改宽度的Table Cell,避免快速移动鼠标的问题
var table = document.getElementById("tb");
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