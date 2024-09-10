<?php

namespace app\service\Asset;


use app\models\Asset;

interface AssetsServiceInterface
{
    public function getDescription(Asset $asset): string;

    public function getModel(Asset $asset): mixed;

    public function delete(Asset $asset): void;
}
