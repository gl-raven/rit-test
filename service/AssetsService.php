<?php


namespace app\service;


class AssetsService
{
    private string $asset_type = '';
    private string $form_class = 'app\\models\\Forms\\Assets\\';
    private string $service_class = 'app\\service\\asset\\';

    public function __construct($asset_type)
    {
        $this->asset_type = $asset_type;
    }

    public function getCreateForm(): string
    {
        return $this->form_class . 'Create' . ucfirst($this->asset_type) . 'AssetForm';
    }

    public function getCreateView(): string
    {
        return 'form/' . $this->asset_type;
    }

    public function getAssetService(): string
    {
        return $this->service_class . ucfirst($this->asset_type) . 'AssetService';
    }

    public function getUpdateView(): string
    {
        return 'form/' . $this->asset_type;
    }

    public function getUpdateForm(): string
    {
        return $this->form_class . 'Update' . ucfirst($this->asset_type) . 'AssetForm';
    }
}
