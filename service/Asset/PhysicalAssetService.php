<?php


namespace app\service\Asset;


use app\models\Asset;
use app\models\Physical;

class PhysicalAssetService implements AssetsServiceInterface
{
    public function getDescription(Asset $asset): string
    {
        $physical = $asset->physical;
        $parts = [];

        $parts[] = $physical->item;

        if ($physical->production_date !== 0) {
            $parts[] = 'дата производства ' . date ('d.m.Y', $physical->production_date);
        }

        $parts[] = 'начальная стоимость ' . $physical->starting_price . ' '. $physical->currency->title;
        $parts[] = 'остаточная стоимость ' . $physical->residual_value . ' '. $physical->currency->title;
        $parts[] = 'оценочная стоимость ' . $physical->estimated_value . ' '. $physical->currency->title;
        if ($physical->inventory_number){
            $parts[] = 'инвентарный номер ' . $physical->inventory_number;
        }


        return implode(', ', $parts);
    }

    public function delete(Asset $asset): void
    {
        $physical = Physical::find()->where(['id' => $asset->id])->one();
        $physical->delete();

        $asset->delete();
    }

    public function getModel(Asset $asset): Physical
    {
        return $asset->physical;
    }
}
