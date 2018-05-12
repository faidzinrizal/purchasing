<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Pemesanan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pemesanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_surat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'tanggal')->widget(DatePicker::className(),[
        'dateFormat' => 'dd-MM-yyyy',
        'options' => [
            'class'=>'form-control'
        ]
    ]); ?>

    <?= $form->field($model,'tanggal_penerimaan')->widget(DatePicker::className(),[
        'dateFormat' => 'dd-MM-yyyy',
        'options' => [
            'class'=>'form-control'
        ]
    ]); ?>

    <?= $form->field($model, 'jumlah_tagihan')->textInput(['disabled'=>'true']) ?>

    <h3>list Penawaran Barang</h3>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Harga yang disepakati</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($penawaran->penawaranDetails as $detail): ?>
                <tr>
                    <td><?= $detail->permintaanDetail->barang->nama; ?></td>
                    <td><?= $detail->permintaanDetail->barang->jenis; ?></td>
                    <td><?= $detail->harga_penawaran; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
