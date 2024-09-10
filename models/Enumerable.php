<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "enumerable".
 *
 * @property int $id
 * @property float $amount
 * @property string|null $place
 * @property string|null $item
 * @property int $account
 * @property int $currency_id
 * @property Currency $currency
 */
class Enumerable extends \yii\db\ActiveRecord
{
    use CurrencyTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enumerable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'amount', 'account'], 'required'],
            [['id', 'amount', 'account'], 'integer'],
            [['place'], 'string', 'max' => 32],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => 'Amount',
            'place' => 'Place',
            'account' => 'Account',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EnumerableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EnumerableQuery(get_called_class());
    }
}
