<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PermintaanDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permintaan-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'permintaan_id')->textInput() ?>

    <?= $form->field($model, 'barang_id')->textInput() ?>

    <?= $form->field($model, 'jumlah')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
