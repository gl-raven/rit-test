<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Physical]].
 *
 * @see Physical
 */
class PhysicalQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Physical[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Physical|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
