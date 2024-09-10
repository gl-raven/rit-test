<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var ActiveForm $form */
/** @var \app\models\Forms\Assets\UpdateEnumerableAssetForm $model */
?>
<?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'amount') ?>
    <?= $form->field($model, 'currency_id')->dropDownList($model->getCurrencyList()) ?>
    <?= $form->field($model, 'item') ?>
    <?= $form->field($model, 'place', ['inputOptions' => ['id' => 'place', 'class' => 'form-control']]) ?>
    <?= $form->field($model, 'account') ?>

    <div class="form-group">
        <div>
            <?= Html::submitButton(($model->id) ? 'Изменить' : 'Добавить', ['class' => 'btn btn-primary',]) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
