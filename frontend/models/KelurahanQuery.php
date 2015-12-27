<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Kelurahan]].
 *
 * @see Kelurahan
 */
class KelurahanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Kelurahan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Kelurahan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}