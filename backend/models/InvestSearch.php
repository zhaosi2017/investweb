<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Invest;

/**
 * InvestSearch represents the model behind the search form about `backend\models\Invest`.
 */
class InvestSearch extends Invest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'filing_time', 'add_time', 'update_time'], 'integer'],
            [['instance_number', 'system_number', 'instance_name', 'filing_unit', 'filing_province', 'instance_detail', 'case_person', 'phone'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = Invest::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'filing_time' => $this->filing_time,
            'add_time' => $this->add_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'instance_number', $this->instance_number])
            ->andFilterWhere(['like', 'system_number', $this->system_number])
            ->andFilterWhere(['like', 'instance_name', $this->instance_name])
            ->andFilterWhere(['like', 'filing_unit', $this->filing_unit])
            ->andFilterWhere(['like', 'filing_province', $this->filing_province])
            ->andFilterWhere(['like', 'instance_detail', $this->instance_detail])
            ->andFilterWhere(['like', 'case_person', $this->case_person])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
