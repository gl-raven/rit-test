<?php

namespace app\models\Forms\Assets;


use yii\base\Model;
use app\models\Asset;

class SelectAssetTypeFrom extends Model
{
  public string $type = '';

    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string'],
            ['type', 'in', 'range' => array_keys($this->getTypeList())],
        ];
    }

    public function attributeLabels()
    {
        return [
            'type' => 'Тип актива',
        ];
    }

    public function getTypeList()
    {
        return [
            Asset::TYPE_ENUMERABLE => 'Денежные',
            Asset::TYPE_PHYSICAL => 'Не денежные'
        ];
    }
}
