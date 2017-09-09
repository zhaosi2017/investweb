<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AuthItem;

/**
 * AuthItemSearch represents the model behind the search form about `common\models\AuthItem`.
 */
class AuthItemSearch extends AuthItem
{

    /**
     * 增加属性.
     *
     * @return array
     */
    public function attributes()
    {
        return array_merge(parent::attributes(), ['search_type', 'search_keywords']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'rule_name', 'data', 'search_type', 'search_keywords'], 'safe'],
            [['type', 'created_at', 'updated_at'], 'integer'],
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
     * @param array $params 搜索条件.
     * @param interger $type (1:为角色, 2为权限).
     *
     * @return ActiveDataProvider
     */
    public function search($params, $type)
    {
        $query = AuthItem::find();

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
            'type' => $type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        /*
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'rule_name', $this->rule_name])
            ->andFilterWhere(['like', 'data', $this->data]);
        */

        $this->search_type ==1 && strlen($this->search_keywords)>0 && $query->andFilterWhere(['like', 'name', $this->search_keywords]);
        $this->search_type ==2 && strlen($this->search_keywords)>0 && $query->andFilterWhere(['like', 'description', $this->search_keywords]);

        return $dataProvider;
    }
}
