<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Kecamatan;

/**
 * KecamatanSearch represents the model behind the search form about `frontend\models\Kecamatan`.
 */
class KecamatanSearch extends Kecamatan
{
	public $nama_provinsi;
	public $nama_kabupaten;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_provinsi', 'nama_kabupaten', 'nama'], 'safe'],
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
        $query = Kecamatan::find();
		$query->joinWith(['kabupaten', 'kabupaten.provinsi']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

		$dataProvider->sort->defaultOrder = ['id_kec'=>SORT_DESC];
		$dataProvider->sort->attributes['nama_provinsi'] = [
			'asc' => ['provinsi.nama' => SORT_ASC],
			'desc' => ['provinsi.nama' => SORT_DESC],
		];
		$dataProvider->sort->attributes['nama_kabupaten'] = [
			'asc' => ['kabupaten.nama' => SORT_ASC],
			'desc' => ['kabupaten.nama' => SORT_DESC],
		];
        $query->andFilterWhere(['like', 'provinsi.nama', $this->nama_provinsi])
            ->andFilterWhere(['like', 'kabupaten.nama', $this->nama_kabupaten])
            ->andFilterWhere(['like', 'kecamatan.nama', $this->nama]);

        return $dataProvider;
    }
}
