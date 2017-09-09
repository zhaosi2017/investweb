<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Alipay;
/**
 * LoginLogsSearch represents the model behind the search form about `app\modules\admin\models\ManagerLoginLogs`.
 */
class AlipaySearch extends Alipay
{

    public $search_keywords;
    public $begin_time;
    public $end_time;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['account','search_keywords','begin_time','end_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    public function attributeLabels()
    {
        return [
            'search_keywords'=>'关键字',
            'begin_time'=>'开始时间',
            'end_time'=>'结束时间',
        ];
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Alipay::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,

        ]);

         if(Yii::$app->params['timeSwith'])
         {
             if($this->begin_time && $this->end_time && ( strtotime($this->begin_time) > strtotime($this->end_time)))
            {
                $tmp = $this->begin_time;
                $this->begin_time = $this->end_time;
                $this->end_time = $tmp;
            }


            if($this->begin_time){
                $begin_time = strtotime($this->begin_time);
                $query->andFilterWhere(['>=','time',$begin_time]);
            }
            if($this->end_time)
            {
                $end_time = strtotime($this->end_time);
                $query->andFilterWhere(['<=','time',$end_time]);
            }


         }

        strlen($this->search_keywords) > 0 && $query->andFilterWhere(['like', 'Alipay.account', $this->search_keywords]);

        return $dataProvider;
    }
}