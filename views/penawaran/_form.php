<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Penawaran */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penawaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'permintaan_id')->textInput() ?>

    <?= $form->field($model, 'supplier_id')->dropDownList($listData, ['prompt' => '-- Pilih Supplier --']) ?>

    <?= $form->field($model, 'no_surat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'tanggal')->widget(DatePicker::className(),[
        'dateFormat' => 'dd-MM-yyyy',
        'options' => [
            'class'=>'form-control'
        ]
    ]); ?>

    <div class='col-lg-4'>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <div class="form-group">
            <?php
            echo Html::button(
            'Lihat Order', 
            [
                'id'=>'btnListOrder', 
                'data-toggle'=>'modal',
                'data-target'=>'#listOrderModal',
                'class'=>'btn btn-success'
            ]); 
            ?>
        </div>
    </div>
    <div class='col-lg-8'></div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="listOrderModal" tabindex="-1" role="dialog" aria-labelledby="listOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="listOrderModalLabel">List Barang Yang Diorder</h3>
            </div>
            <div class="modal-body">
            <?php
            echo GridView::widget([
                'dataProvider' => $dataProviderBarang,
                'columns' => [
                    'barang.nama',
                    'barang.jenis',
                    'jumlah',
                ],
            ]);

            ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

