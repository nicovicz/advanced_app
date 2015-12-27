<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%company}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $phone
 * @property string $id_kel
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'id_kel'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['phone'], 'number'],
            [['address'], 'string'],
            [['name', 'email', 'phone'], 'string', 'max' => 255],
            [['id_kel'], 'string', 'max' => 10],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'id_kel' => Yii::t('app', 'Kelurahan Name'),
        ];
    }

    /**
     * @inheritdoc
     * @return CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyQuery(get_called_class());
    }
    
    public function getKelurahan()
	{
		return $this->hasOne(Kelurahan::className(), ['id_kel'=>'id_kel']);
	}
    
    
}
