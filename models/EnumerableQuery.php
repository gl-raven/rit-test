<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Enumerable]].
 *
 * @see Enumerable
 */
class EnumerableQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Enumerable[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Enumerable|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
