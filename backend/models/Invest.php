<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "invest".
 *
 * @property integer $id
 * @property string $instance_number
 * @property string $system_number
 * @property string $instance_name
 * @property string $filing_unit
 * @property string $filing_province
 * @property string $instance_detail
 * @property string $case_person
 * @property string $phone
 * @property integer $filing_time
 * @property integer $add_time
 * @property integer $update_time
 */
class Invest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invest';
    }

    /**
     * 更新时间自动更新设置.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'add_time',
                'updatedAtAttribute' => 'update_time',
            ]
        ];
    }

    /**
     *
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!is_int($this->filing_time)) {
                $this->filing_time = strtotime($this->filing_time);
            }
        } else {
            return false;
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['instance_number', 'system_number', 'instance_name', 'filing_unit', 'filing_province', 'instance_detail', 'case_person', 'charge_person', 'phone', 'filing_time'], 'required'],
            [['instance_detail'], 'string'],
            [['add_time', 'update_time'], 'integer'],
            [['instance_number', 'system_number', 'instance_name', 'filing_unit', 'charge_person'], 'string', 'max' => 100],
            [['filing_province'], 'string', 'max' => 30],
            [['case_person', 'phone'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'instance_number' => '实例编号',
            'system_number' => '系统编号',
            'instance_name' => '实例名',
            'filing_unit' => '立案单位',
            'filing_province' => '立案省份',
            'instance_detail' => '实例详情',
            'charge_person' => '负责人',
            'case_person' => '办案人员',
            'phone' => '联系方式',
            'filing_time' => '立案时间',
            'add_time' => '添加时间',
            'update_time' => '修改时间',
        ];
    }

}
