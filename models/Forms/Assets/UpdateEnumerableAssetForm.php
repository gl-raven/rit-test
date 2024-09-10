<?php


namespace app\models\Forms\Assets;


use app\models\Asset;

class UpdateEnumerableAssetForm extends CreateEnumerableAssetForm
{
    private Asset $asset;

    public function __construct(Asset $asset, $config = [])
    {
        parent::__construct($config);

        $this->asset = $asset;
        $this->id = $this->asset->enumerable->id;
        $this->amount = $this->asset->enumerable->amount;
        $this->place = $this->asset->enumerable->place;
        $this->account = $this->asset->enumerable->account ?: '';
        $this->item = $this->asset->enumerable->item;
        $this->currency_id = $this->asset->enumerable->currency_id;
    }

    public function save(): Asset
    {
        $this->asset->enumerable->amount = $this->amount;
        $this->asset->enumerable->place = $this->place;
        $this->asset->enumerable->account = $this->account !== '' ? (int) $this->account : 0;
        $this->asset->enumerable->item = $this->item;
        $this->asset->enumerable->currency_id = $this->currency_id;

        $this->asset->enumerable->save(false);

        return $this->asset;
    }
}
