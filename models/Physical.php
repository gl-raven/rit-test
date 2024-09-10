<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "physical".
 *
 * @property int $id
 * @property float $starting_price
 * @property float $residual_value
 * @property float $estimated_value
 * @property int $currency_id
 * @property int $inventory_number
 * @property int $production_date
 * @property string $item
 * @property Currency $currency
 */
class Physical extends \yii\db\ActiveRecord
{
    use CurrencyTrait;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'physical';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'starting_price', 'residual_value', 'estimated_value', 'currency_id', 'inventory number', 'production_date'], 'required'],
            [['id', 'currency_id', 'inventory number', 'production_date'], 'integer'],
            [['starting_price', 'residual_value', 'estimated_value'], 'number'],
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
            'starting_price' => 'Starting Price',
            'residual_value' => 'Residual Value',
            'estimated_value' => 'Estimated Value',
            'currency_id' => 'Currency ID',
            'inventory number' => 'Inventory Number',
            'production_date' => 'Production Date',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PhysicalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PhysicalQuery(get_called_class());
    }
}
