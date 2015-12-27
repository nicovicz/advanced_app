<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Kabupaten;

/**
 * KabupatenSearch represents the model behind the search form about `frontend\models\Kabupaten`.
 */
class KabupatenSearch extends Kabupaten
{
	public $nama_provinsi;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kab', 'nama_provinsi', 'nama'], 'safe'],
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
        $query = Kabupaten::find();
		$query->joinWith(['provinsi']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		$dataProvider->sort->defaultOrder = ['id_kab'=>SORT_DESC];
		$dataProvider->sort->attributes['nama_provinsi'] = [
			'asc' => ['provinsi.nama' => SORT_ASC],
			'desc' => ['provinsi.nama' => SORT_DESC],
		];
        $query->andFilterWhere(['like', 'kabupaten.id_kab', $this->id_kab])
            ->andFilterWhere(['like', 'provinsi.nama', $this->nama_provinsi])
            ->andFilterWhere(['like', 'kabupaten.nama', $this->nama]);

        return $dataProvider;
    }
}
