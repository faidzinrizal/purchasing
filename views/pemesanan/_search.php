<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PemesananSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemesanan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'penawaran_id') ?>

    <?= $form->field($model, 'no_surat') ?>

    <?= $form->field($model, 'tanggal') ?>

    <?= $form->field($model, 'tanggal_penerimaan') ?>

    <?php // echo $form->field($model, 'jumlah_tagihan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
