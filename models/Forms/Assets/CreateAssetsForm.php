<?php


namespace app\models\Forms\Assets;


use yii\base\Model;

class CreateAssetsForm extends Model
{
    public string $type = '';
    
    public function rules()
    {
        return [
            [['type', 'name',], 'required'],
            [['type'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'type' => 'Тип актива',
        ];
    }
    
    
}
