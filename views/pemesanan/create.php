<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pemesanan */

$this->title = 'Create Pemesanan ke ' . $penawaran->supplier->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pemesanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemesanan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'penawaran' => $penawaran,
    ]) ?>

</div>
