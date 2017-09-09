<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use backend\models\AlipayWarn;
use yii\web\UploadedFile;

/**
 * LoginForm is the model behind the login form.
 *
 * @property $user This property is read-only.
 *
 */
class AlipayWarnForm extends Model
{
    public $title;
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['title'],'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title'=>'预警搜索信息',
        ];
    }

    public function create()
    {
        $alipayWarn = AlipayWarn::find()->one();
        if(!empty($alipayWarn)){
            $alipayWarn->title = $this->title;
            $alipayWarn->opreate_id = (int)Yii::$app->user->id;
            return $alipayWarn->save();
        }else{
            $alipayWarn = new AlipayWarn();
            $alipayWarn->title = $this->title;
            $alipayWarn->create_at = time();
            $alipayWarn->opreate_id = (int)Yii::$app->user->id;
            return $alipayWarn->save();
        }
    }


}