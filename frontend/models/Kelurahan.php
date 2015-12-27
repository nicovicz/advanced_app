<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%kelurahan}}".
 *
 * @property string $id_kel
 * @property string $id_kec
 * @property string $nama
 */
class Kelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kelurahan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_kel', 'id_kec', 'nama'], 'required'],
            [['id_kel'], 'string', 'max' => 10],
            [['id_kec'], 'string', 'max' => 7],
            [['nama'], 'string', 'max' => 40]
        ];
    }
    
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_kel' => Yii::t('app', 'Kelurahan Name'),
            'id_kec' => Yii::t('app', 'Kecamatan Name'),
            'nama' => Yii::t('app', 'Kelurahan Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return KelurahanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new KelurahanQuery(get_called_class());
    }
    
    public function autoNumber()
    {
		$model = self::find()->select("MAX(id_kel) as id_kel")
			->where(['id_kec'=>$this->id_kec])
			->one();
		
	    if (!empty($model->id_kel)) {
			
			$part = substr($model->id_kel, strlen($this->id_kec));
			$increment = intval($part)+1;
			return $this->id_kel = sprintf('%010s',$this->id_kec.$increment);
		}
		
		return $this->id_kel = sprintf('%010s', $this->id_kec.'001');
		
	}
	
	public function getKecamatan()
	{
		return $this->hasOne(Kecamatan::className(), ['id_kec'=>'id_kec']);
	}
	
	
}
