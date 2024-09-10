<?php
/** @var yii\web\View $this */
/** @var \yii\data\ActiveDataProvider $dataProvider */

use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Список активов';

?>
<h1><?= $this->title ?> <a class="btn btn-primary" role="button" href="<?= Url::to(['/assets/create'])?>">Добавить</a></h1>

<p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'description',
            ['class' => 'yii\grid\ActionColumn' ,'template' => '{update} {delete}'],
        ],
    ]); ?>
</p>
