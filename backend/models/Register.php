<?php
namespace backend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class Register extends User
{
    
	public $password;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique'],

            ['password', 'required', 'when'=> function($model){
				return $model->isNewRecord;
			}, 'enableClientValidation'=>$this->isNewRecord],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
           
            $this->setPassword($this->password);
            $this->generateAuthKey();
            if ($this->save()) {
                return $this;
            }
        }

        return null;
    }
    
    public function change()
    {
        if ($this->validate()) {
           
            if (!empty($this->password)){
				$this->setPassword($this->password);
				$this->generateAuthKey();
			}
            
            if ($this->save()) {
                return $this;
            }
        }

        return null;
    }
    
    
}
