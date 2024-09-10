<?php


namespace app\models\Forms\Assets;


use app\models\Asset;

class UpdatePhysicalAssetForm extends CreatePhysicalAssetForm
{
    private Asset $asset;

    public function __construct(Asset $asset, $config = [])
    {
        parent::__construct($config);

        $this->asset = $asset;
        $this->id = $this->asset->physical->id;
        $this->starting_price = $this->asset->physical->starting_price;
        $this->residual_value = $this->asset->physical->residual_value;
        $this->estimated_value = $this->asset->physical->estimated_value;
        $this->currency_id = $this->asset->physical->currency_id;
        $this->inventory_number = $this->asset->physical->inventory_number ?: '';
        $this->production_date = $this->asset->physical->production_date ?: '';
        $this->item = $this->asset->physical->item;
    }

    public function save(): Asset
    {
        $this->asset->physical->starting_price = $this->starting_price;
        $this->asset->physical->residual_value = $this->residual_value;
        $this->asset->physical->estimated_value = $this->estimated_value;
        $this->asset->physical->currency_id = $this->currency_id;
        $this->asset->physical->inventory_number = $this->inventory_number ?: 0;
        $this->asset->physical->production_date = $this->production_date ? strtotime($this->production_date): 0;
        $this->asset->physical->item = $this->item;

        $this->asset->physical->save(false);
        return $this->asset;
    }
}
