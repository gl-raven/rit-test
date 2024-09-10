<?php
/** @var yii\web\View $this */
/** @var \yii\base\Model $model */
/** @var \app\service\AssetsService $assetService */

$this->title = 'Изменение актива №' . $model->id;
?>
<h3><?= $this->title; ?></h3>

<?= $this->render($assetService->getCreateView(), ['model' => $model]) ?>
