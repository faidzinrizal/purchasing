<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenawaranDetail */

$this->title = 'Update Penawaran Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penawaran Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penawaran-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
