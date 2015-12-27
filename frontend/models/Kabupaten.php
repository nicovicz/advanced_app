<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%kabupaten}}".
 *
 * @property string $id_kab
 * @property string $id_prov
 * @property string $nama
 */
class Kabupaten extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kabupaten}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kab', 'id_prov', 'nama'], 'required'],
            [['id_kab'], 'string', 'max' => 4],
            [['id_prov'], 'string', 'max' => 2],
            [['nama'], 'string', 'max' => 30]
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['DepDrop'] = ['id_kab'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kab' => Yii::t('app', 'Kabupaten Name'),
            'id_prov' => Yii::t('app', 'Provinsi Name'),
            'nama' => Yii::t('app', 'Kabupaten Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return KabupatenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KabupatenQuery(get_called_class());
    }
    
    public function autoNumber()
    {
		$model = self::find()->select("MAX(id_kab) as id_kab")
			->where(['id_prov'=>$this->id_prov])
			->one();
		
	    if (!empty($model->id_kab)) {
			
			$part = substr($model->id_kab, strlen($this->id_prov));
			$increment = intval($part)+1;
			return $this->id_kab = sprintf('%04s',$this->id_prov.$increment);
		}
		
		return $this->id_kab = sprintf('%04s', $this->id_prov.'01');
		
	}
	
	public function getProvinsi()
	{
		return $this->hasOne(Provinsi::className(), ['id_prov'=>'id_prov']);
	}
	
	public function getKecamatans()
	{
		return $this->hasMany(Kecamatan::className(), ['id_kab'=> 'id_kab']);
	}
}
