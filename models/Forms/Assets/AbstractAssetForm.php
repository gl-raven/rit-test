<?php


namespace app\models\Forms\Assets;


use app\models\Currency;
use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract class AbstractAssetForm extends Model
{
    public function getCurrencyList(): array
    {
        return ArrayHelper::map(Currency::find()->all(), 'id', 'title');
    }
}
