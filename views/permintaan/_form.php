<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/* @var $this yii\web\View */
/* @var $model app\models\Permintaan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="permintaan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_permintaan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'tanggal')->widget(DatePicker::className(),[
        'dateFormat' => 'dd-MM-yyyy',
        'options' => [
            'class'=>'form-control'
        ]
    ]); ?>

    <?= $form->field($model, 'deskripsi')->textInput(['maxlength' => true]) ?>



    <!-- form grid barang -->
    <h3>Data Barang</h3>
    <?php 
    Pjax::begin(['id' => 'pjax-grid-barang']);
        echo $this->render('_form_grid_barang', ['dataProvider'=> $dataProvider]);
    Pjax::end(); 
    ?>



    <div class="form-group">
        <?php
        echo Html::button(
            'Tambah barang', 
            [
                'id'=>'btnTambah', 
                'data-toggle'=>'modal',
                'data-target'=>'#barangModal',
                'class'=>'btn btn-primary'
            ]);
        ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Modal -->
<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="barangModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="barangModalLabel">Barang</h2>
            </div>
            <div class="modal-body">
            <?php
            echo GridView::widget([
                'dataProvider' => $barangProvider,
                'columns' => [
                    'nama',
                    'jenis',
                    [
                        'label' => 'jumlah',
                        'value' => function($data) {
                            return Html::input(
                                'text',
                                'barangJumlah',
                                '',
                                [
                                    'class'=>'form-control',
                                    'id'=>'barangJumlah-' . $data->id,
                                ]
                            );
                        },
                        'format'=>'raw'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{tambah}',
                        'buttons' => [
                            'tambah' => function($url, $model, $key) {
                                return Html::button(
                                'Tambah barang', 
                                [
                                    'id'=>'btnTambahBarang', 
                                    'class'=>'btn btn-primary',
                                    'onclick'=>"js:ajaxTambahBarang($key);",
                                ]);
                            }
                        ]
                    ],
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



<script type="text/javascript">

    function ajaxTambahBarang(id) {
        var jumlah = $('#barangJumlah-' + id).val();
        $('#barangJumlah-' + id).val('');
        if (jumlah == '') {
            alert("Jumlah harus diisi dan berupa angka.");
            return false;
        } 

        $.ajax({
            type:'POST',
            data: {
                id: id,
                jumlah: jumlah,
            },
            url: '<?= Url::to(['permintaan/tambahbarang']); ?>',
            success: function(res) {
                console.log(res);
                $('#gridbarang').html(res);
                // $.pjax({container: '#pjax-grid-barang'});
            }
        });
    }


    function ajaxHapusBarang(id) {
        $.ajax({
            type:'POST',
            data: {
                id: id,
            },
            url: '<?= Url::to(['permintaan/hapusbarang']); ?>',
            success: function(res) {
                $('#gridbarang').html(res);
            }
        });
    }
</script>

<?php
$this->registerJs(
    "
    $( document ).ready(function() {
        $('#tanggal').datepicker();
    });
    ",
    View::POS_READY
);
