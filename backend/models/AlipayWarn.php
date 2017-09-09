<?php

namespace backend\models;

//use Yii;
use backend\models\GActiveRecord;

/**
 * This is the model class for table "manager_login_logs".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $status
 * @property string $login_time
 * @property string $login_ip
 */
class AlipayWarn extends GActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alipay-warn';
    }
}