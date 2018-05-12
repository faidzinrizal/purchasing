<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermintaanDetail */

$this->title = 'Create Permintaan Detail';
$this->params['breadcrumbs'][] = ['label' => 'Permintaan Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
