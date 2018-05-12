<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenawaranDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penawaran-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'penawaran_id')->textInput() ?>

    <?= $form->field($model, 'permintaan_detail_id')->textInput() ?>

    <?= $form->field($model, 'harga_penawaran')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
