<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Synonym;

/**
 * SynonymSearch represents the model behind the search form of `app\models\Synonym`.
 */
class SynonymSearch extends Synonym
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'skill_id'], 'integer'],
            [['synonym_text','skillCleanedText'], 'safe'],
            [['is_original'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Synonym::find()->innerJoin('skill',' synonym.skill_id = skill.id');

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
            'skill_id' => $this->skill_id,
            'is_original' => $this->is_original,

        ]);

        $query->andFilterWhere(['like', 'synonym_text', $this->synonym_text]);
        $query->andFilterWhere(['like', 'skill.cleaned_text', $this->skillCleanedText]);
        $dataProvider->sort->attributes['skillCleanedText'] = [

            'asc' => ['skill.cleaned_text' => SORT_ASC],
            'desc' => ['skill.cleaned_text' => SORT_DESC],
        ];


        return $dataProvider;
    }
}
