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
class Alipay extends GActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alipay';
    }

    public function rules()
    {
        return [
                [['id','time'],'integer'],
                [['title','detail','account'],'string'],
                ['detail','required','on'=>['update-detail']],
            ];
    }

    public function attributeLabels()
    {
        return [
            'id'=>'编号',
            'systime'=>'系统日期',
            'time'=>'时间',
            'title'=>'名例名称',
            'detail'=>'名例详情',
            'account'=>'调取账户',
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $res = [
            'update-detail' => ['detail'],
        ];
        return array_merge($scenarios, $res);
    }

    public static function find()
    {
        return new AlipayQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord)
        {   $id =  \Yii::$app->user->id ? \Yii::$app->user->id: 0;
            $this->create_at = time();
            $this->opreate_id = $id;
        }
        return true;
    }

    public function oneSearch($title)
    {
        $ids = $this->searchIds($title);
        $res = self::find()->where(['in','alipay.id',$ids]);
        return $res;
    }




    public function searchIds($title)
    {
        $ids = [0];
        $title = explode(',',$title);
        if(empty($title))
        {
            return $ids;
        }
        foreach ($title as $k=>$v)
        {
            if(empty($v)){
                continue;
            }
            $res = self::find()->where(['like','account',$v])->select('id,account')->all();
            if(empty($res))
            {
                continue;

            }else{

                foreach ($res as $row)
                {
                    $pos = strpos($row['account'],$v);
                    if(is_int($pos)){
                        $ids[] = $row['id'];
                    }
                }
            }
        }
        $ids = array_unique($ids);
        return $ids;
    }


}