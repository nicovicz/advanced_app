<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%provinsi}}".
 *
 * @property string $id_prov
 * @property string $nama
 */
class Provinsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%provinsi}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_prov','nama'], 'required'],
            [['id_prov'], 'string', 'max' => 2],
            [['nama'], 'string', 'max' => 30],
           
        ];
    }
    
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['DepDrop'] = ['id_prov'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_prov' => Yii::t('app', 'Provinsi Name'),
            'nama' => Yii::t('app', 'Provinsi Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return ProvinsiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProvinsiQuery(get_called_class());
    }
    
    public function autoNumber()
    {
		$model = self::find()->select("MAX(id_prov) as id_prov")
			->one();
			
	    $result = !empty($model->id_prov)?intval($model->id_prov) + 1:1;
	    
	    return $this->id_prov = sprintf('%02s',$result);
	    
		
	}
	
	public function getKabupatens()
	{
		return $this->hasMany(Kabupaten::className(), ['id_prov'=>'id_prov']);
	}
	
	
}
