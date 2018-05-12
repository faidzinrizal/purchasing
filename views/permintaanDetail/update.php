<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PermintaanDetail */

$this->title = 'Update Permintaan Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="permintaan-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>