<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var ActiveForm $form */
/** @var \app\models\Forms\Assets\CreateEnumerableAssetForm $model */
?>
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'item') ?>
    <?= $form->field($model, 'starting_price') ?>
    <?= $form->field($model, 'residual_value') ?>
    <?= $form->field($model, 'estimated_value') ?>
    <?= $form->field($model, 'currency_id')->dropDownList($model->getCurrencyList()) ?>
    <?= $form->field($model, 'inventory_number') ?>
    <?= $form->field($model, 'production_date', ['labelOptions' => ['class' => 'control-label col-sm-2']])->widget(\yii\jui\DatePicker::classname(), [
        'options' => ['autocomplete' => 'off', 'class' => 'form-control'],
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
    ]) ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton(($model->id) ? 'Изменить' : 'Добавить', ['class' => 'btn btn-primary',]) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
