<?php


namespace app\service\Asset;


use app\models\Asset;
use app\models\Enumerable;

class EnumerableAssetService implements AssetsServiceInterface
{
    public function getDescription(Asset $asset): string
    {
        $enumerable = $asset->enumerable;
        if (empty($enumerable->place)) {
            return 'В кассе ' . ($enumerable->item ? $enumerable->item . ' на ': '') . $enumerable->amount . ' ' . $enumerable->currency->title;
        } else {
            return 'На счету №' . $enumerable->account . ' в ' . $enumerable->place . ' ' . $enumerable->amount . ' ' . $enumerable->currency->title;
        }
    }

    public function delete(Asset $asset): void
    {
        $enumerable = Enumerable::find()->where(['id' => $asset->id])->one();
        $enumerable->delete();

        $asset->delete();
    }


    public function getModel(Asset $asset): Enumerable
    {
        return $asset->enumerable;
    }
}
