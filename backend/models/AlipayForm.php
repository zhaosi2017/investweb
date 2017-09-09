<?php

namespace backend\models;
use Yii;
use yii\base\Model;
use backend\models\Admin;
use yii\web\UploadedFile;

/**
 * LoginForm is the model behind the login form.
 *
 * @property $user This property is read-only.
 *
 */
class AlipayForm extends Model
{
    public $file;

    public function rules()
    {
        return [
            [['file'], 'file','maxSize'=>'40000000'],
            [['file'],'required'],

        ];
    }

    public function attributeLabels()
    {
        return [
          'file'=>'预警文件',
        ];
    }





}