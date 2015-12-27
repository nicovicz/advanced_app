<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Company;

/**
 * CompanySearch represents the model behind the search form about `frontend\models\Company`.
 */
class CompanySearch extends Company
{
	public $nama_provinsi;
	public $nama_kabupaten;
	public $nama_kecamatan;
	public $nama_kelurahan;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'address', 'email', 'phone', 
			  'nama_provinsi', 'nama_kabupaten',
			   'nama_kecamatan', 'nama_kelurahan'], 'safe'],
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
        $query = Company::find();
		$query->joinWith([
			'kelurahan.kecamatan.kabupaten.provinsi',
			'kelurahan.kecamatan.kabupaten',
			'kelurahan.kecamatan',
			'kelurahan'
		]);
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $dataProvider->sort->defaultOrder = ['id'=>SORT_DESC];
		$dataProvider->sort->attributes['nama_provinsi'] = [
			'asc' => ['provinsi.nama' => SORT_ASC],
			'desc' => ['provinsi.nama' => SORT_DESC],
		];
		$dataProvider->sort->attributes['nama_kabupaten'] = [
			'asc' => ['kabupaten.nama' => SORT_ASC],
			'desc' => ['kabupaten.nama' => SORT_DESC],
		];
		$dataProvider->sort->attributes['nama_kecamatan'] = [
			'asc' => ['kecamatan.nama' => SORT_ASC],
			'desc' => ['kecamatan.nama' => SORT_DESC],
		];
		$dataProvider->sort->attributes['nama_kelurahan'] = [
			'asc' => ['kelurahan.nama' => SORT_ASC],
			'desc' => ['kelurahan.nama' => SORT_DESC],
		];

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'provinsi.nama', $this->nama_provinsi])
            ->andFilterWhere(['like', 'kabupaten.nama', $this->nama_kabupaten])
            ->andFilterWhere(['like', 'kecamatan.nama', $this->nama_kecamatan])
            ->andFilterWhere(['like', 'kelurahan.nama', $this->nama_kelurahan]);

        return $dataProvider;
    }
}
