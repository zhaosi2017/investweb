<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = '修改详情';
$this->params['breadcrumbs'][] = ['label' => '支付宝预警', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <div class="">
        <form class="form-horizontal m-t" action="/alipay/update?id=<?= $model->id ?>" method="post">
            <input id="form-token" type="hidden" name="_csrf"
                   value="<?=Yii::$app->request->csrfToken?>"/>
            <div class="form-group">
                <label class="col-sm-2"  for="title">名例名称</label>
                <div class="col-sm-4">
                    <input class="form-control" name="Alipay[title]" id = "title" type="text" value="<?php echo $model->title;?>">

                </div>
                <div class="col-sm-6"></div>

            </div>
            <div class="col-sm-12"></div>
            <div class="form-group">
                <label class="col-sm-2" for="detail">名例详情</label>
                <div class="col-sm-4">
                <textarea class="form-control"   onfocus="detailSpan()" name="Alipay[detail]" style="height: 120px;max-height: 120px;"  id = "detail" type="text" ><?php echo $model->detail;?></textarea>
                </div>

                    <div class="col-sm-6"></div>
                <div class="col-sm-12"></div>
                <label  class="col-sm-2" for=""></label>

                <span id="detailspan"  style="color: red;" class="col-sm-4">
                    <?php
                        $errors = $model->getErrors();
                        if(isset($errors['detail'][0])) {
                            echo $errors['detail'][0];
                        }
                    ?>
                </span>
                <div class="col-sm-6"></div>
                <div class="col-sm-12"></div>
            </div>
            <div class="col-sm-12"></div>
            <div class="form-group">
                <label class="col-sm-2" for="account">调取账户</label>
                <div class="col-sm-4">
                <textarea class=" form-control"  name="Alipay[account]" style="max-height: 120px;height: 120px;" id = "account" type="text" ><?php echo $model->account;?></textarea>
                </div>
                <div class="col-sm-6"></div>

            </div>
            <div class="col-sm-12"></div>
            <div class="form-group" style="display:none;">
                <label class="col-sm-2" for="systime">系统日期</label>
                <div class="col-sm-4">
                <input class=" form-control"  name="Alipay[systime]" id = "systime" type="text" value="<?php echo $model->systime;?>">
                </div>
                    <div class="col-sm-6"></div>

            </div>

            <div class="col-sm-12"></div>
            <div class="form-group">
                <div>
                    <labe class ="col-sm-2"></labe>
                    <div class="col-sm-4">
                    <button  class="btn btn-primary" style="    width: 100%;">修改</button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>
<script>
    function detailSpan() {
        $('#detailspan').html('');
    }
</script>