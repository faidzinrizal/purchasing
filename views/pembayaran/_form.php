<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pembayaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pemesanan_id')->textInput() ?>

    <?= $form->field($model, 'tanggal')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jumlah_bayar')->textInput() ?>

    <?= $form->field($model, 'sisa_tagihan')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
