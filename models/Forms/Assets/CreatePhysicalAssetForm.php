<?php


namespace app\models\Forms\Assets;


use app\models\Asset;
use app\models\Currency;
use app\models\Enumerable;
use app\models\Physical;
use yii\base\BaseObject;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class CreatePhysicalAssetForm extends AbstractAssetForm
{
    public string $type = 'physical';

    public int $id = 0;
    public float $starting_price = 0;
    public float $residual_value = 0;
    public float $estimated_value = 0;
    public int $currency_id = 1;
    public string $inventory_number = '';
    public string $production_date = '';
    public string $item = '';

    public function rules()
    {
        return [
            [['starting_price', 'residual_value', 'estimated_value', 'currency_id', 'item'], 'required'],
            [['starting_price', 'residual_value', 'estimated_value'], 'number'],
            ['currency_id', 'in', 'range' => array_keys($this->getCurrencyList())],
            [['inventory_number', 'currency_id'], 'integer'],
            ['item', 'string'],
            ['production_date', 'date', 'format' => 'php:d.m.Y'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'starting_price' => 'Начальная балансовая стоимость',
            'residual_value' => 'Остаточная стоимость',
            'estimated_value' => 'Оценочная стоимость',
            'currency_id' => 'Валюта',
            'inventory_number' => 'Инвентарный номер',
            'production_date' => 'Дата производства',
            'item' => 'Название актива',
        ];
    }

    public function save(): Asset
    {
        $asset = new Asset();
        $asset->type = $this->type;
        $asset->save(false);

        $physical = new Physical();
        $physical->id = $asset->id;
        $physical->starting_price = $this->starting_price;
        $physical->residual_value = $this->residual_value;
        $physical->estimated_value = $this->estimated_value;
        $physical->currency_id = $this->currency_id;
        $physical->inventory_number = $this->inventory_number !== '' ? (int) $this->inventory_number : 0;
        $physical->production_date = $this->production_date !== '' ? strtotime($this->production_date) : 0;
        $physical->item = $this->item;

        $physical->save(false);

        return $asset;
    }
}
