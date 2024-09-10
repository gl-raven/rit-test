<?php

namespace app\models;

use app\service\Asset\AssetsServiceInterface;
use app\service\AssetsService;
use Yii;

/**
 * This is the model class for table "assets".
 *
 * @property int $id
 * @property string $type
 * @property Enumerable $enumerable
 * @property Physical $physical
 */
class Asset extends \yii\db\ActiveRecord
{
    const TYPE_ENUMERABLE = 'enumerable';
    const TYPE_PHYSICAL = 'physical';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
        ];
    }

    /**
     * {@inheritdoc}
     * @return AssetsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AssetsQuery(get_called_class());
    }

    public function getEnumerable()
    {
        return $this->hasOne(Enumerable::className(), ['id' => 'id']);
    }

    public function getPhysical()
    {
        return $this->hasOne(Physical::className(), ['id' => 'id']);
    }

    public function getDescription(): string
    {
        $assetService = new AssetsService($this->type);

        /** @var AssetsServiceInterface $assetItemService */
        $assetItemService = new ($assetService->getAssetService());
        return $assetItemService->getDescription($this);
    }
}
