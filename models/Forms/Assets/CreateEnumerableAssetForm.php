<?php


namespace app\models\Forms\Assets;


use app\models\Asset;
use app\models\Enumerable;

class CreateEnumerableAssetForm extends AbstractAssetForm
{
    public int $id = 0;
    public string $type = 'enumerable';
    public float $amount = 0;
    public int $currency_id = 1;
    public string $item = '';
    public string $place = '';
    public string $account = '';

    public function rules()
    {
        return [
            [['amount', 'currency_id'], 'required'],
            [['amount'], 'number'],
            [['item', 'place'], 'string'],
            ['currency_id', 'in', 'range' => array_keys($this->getCurrencyList())],
            ['account', 'integer', 'min' => 0],
            ['account', 'required', 'when' => function ($model) {
                return $model->place !== '';
            }, 'whenClient' => "function (attribute, value) {
                return $('#place').val() != '';
            }"
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'amount' => 'Сумма',
            'currency_id' => 'Валюта',
            'item' => 'Название',
            'place' => 'Банк',
            'account' => 'Счет',
        ];
    }

    public function save(): Asset
    {
        $asset = new Asset();
        $asset->type = $this->type;
        $asset->save(false);

        $enumerable = new Enumerable();
        $enumerable->id = $asset->id;
        $enumerable->amount = $this->amount;
        $enumerable->place = $this->place;
        $enumerable->account = $this->account !== '' ? (int) $this->account : 0;
        $enumerable->item = $this->item;
        $enumerable->currency_id = $this->currency_id;
        $enumerable->save(false);

        return $asset;
    }
}
