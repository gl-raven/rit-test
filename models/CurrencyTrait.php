<?php


namespace app\models;


trait CurrencyTrait
{
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
}
