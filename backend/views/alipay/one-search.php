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

<table class="table table-striped table-bordered">
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