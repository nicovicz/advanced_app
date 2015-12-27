<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%kecamatan}}".
 *
 * @property string $id_kec
 * @property string $id_kab
 * @property string $nama
 */
class Kecamatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kecamatan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kec', 'id_kab', 'nama'], 'required'],
            [['id_kec'], 'string', 'max' => 7],
            [['id_kab'], 'string', 'max' => 4],
            [['nama'], 'string', 'max' => 30]
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['DepDrop'] = ['id_kec'];
        return $scenarios;
    }
    
   

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kec' => Yii::t('app', 'Kecamatan Name'),
            'id_kab' => Yii::t('app', 'Kabupaten Name'),
            'nama' => Yii::t('app', 'Kecamatan Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return KecamatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KecamatanQuery(get_called_class());
    }
    
    public function autoNumber()
    {
		$model = self::find()->select("MAX(id_kec) as id_kec")
			->where(['id_kab'=>$this->id_kab])
			->one();
		
	    if (!empty($model->id_kec)) {
			
			$part = substr($model->id_kec, strlen($this->id_kab));
			$increment = intval($part)+1;
			return $this->id_kec = sprintf('%07s',$this->id_kab.$increment);
		}
		
		return $this->id_kec = sprintf('%07s', $this->id_kab.'001');
		
	}
	
	public function getKabupaten()
	{
		return $this->hasOne(Kabupaten::className(), ['id_kab'=>'id_kab']);
	}
	
	public function getKelurahans()
	{
		return $this->hasMany(Kelurahan::className(), ['id_kec'=> 'id_kec']);
	}
}
