<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Provinsi;

/**
 * ProvinsiSearch represents the model behind the search form about `frontend\models\Provinsi`.
 */
class ProvinsiSearch extends Provinsi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prov', 'nama'], 'safe'],
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
        $query = Provinsi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		$dataProvider->sort->defaultOrder = ['id_prov'=>SORT_DESC];
		
        $query->andFilterWhere(['like', 'id_prov', $this->id_prov])
            ->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }
}
