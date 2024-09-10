<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Forms\Assets\SelectAssetTypeFrom $assetTypeModel */
/** @var \yii\base\Model $model */
/** @var \app\service\AssetsService $assetService */
/** @var ActiveForm $form */

$this->title = 'Новый актив';
?>
<div class="assets-create">
    <h3><?= $this->title; ?></h3>
    <?php $form = ActiveForm::begin(['action' => [''], 'method' => 'get']); ?>

    <?= $form->field($assetTypeModel, 'type')->dropDownList($assetTypeModel->getTypeList(), [
        'prompt' => 'Выберите типа актива...',
        'onchange'=>'this.form.submit()',
    ]) ?>
    <?php ActiveForm::end(); ?>

    <?php if (!is_null($model)): ?>
        <?= $this->render($assetService->getCreateView(), ['model' => $model]) ?>
    <?php endif; ?>
</div><!-- assets-create -->
