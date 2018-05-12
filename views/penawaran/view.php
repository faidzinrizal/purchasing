<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Penawaran */

$this->title = 'Penawaran ke ' . $model->supplier->nama;
$this->params['breadcrumbs'][] = ['label' => 'Penawarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penawaran-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
        //echo Html::a('Delete', ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => 'Are you sure you want to delete this item?',
        //         'method' => 'post',
        //     ],
        // ]) 
        ?>
        <?php
            if($model->status == 'Pengajuan') {
                echo Html::button(
                'Input Hasil Penawaran', 
                [ 
                    'data-toggle'=>'modal',
                    'data-target'=>'#hasilPenawaranModal',
                    'class'=>'btn btn-success'
                ]); 
            } else {
                echo Html::button(
                'Ubah Status', 
                [ 
                    'data-toggle'=>'modal',
                    'data-target'=>'#ubahStatusModal',
                    'class'=>'btn btn-primary'
                ]);
                echo ' ';
                echo Html::button(
                'Lihat Penawaran', 
                [ 
                    'data-toggle'=>'modal',
                    'data-target'=>'#viewPenawaranModal',
                    'class'=>'btn btn-default'
                ]);
            }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'permintaan_id',
            'supplier.nama',
            'no_surat',
            'tanggal',
            'status',
        ],
    ]) ?>

</div>


<!-- Modal -->
<div class="modal fade" id="hasilPenawaranModal" tabindex="-1" role="dialog" aria-labelledby="hasilPenawaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="hasilPenawaranModalLabel">Input Penawaran Harga</h2>
            </div>
            <div class="modal-body">
            <?php
            $model_id = $model->id;
            echo GridView::widget([
                'dataProvider' => $orderProvider,
                'columns' => [
                    'barang.nama',
                    'barang.jenis',
                    'jumlah',
                    [
                        'label' => 'Harga',
                        'value' => function($data) use ($model_id) {
                            return Html::input(
                                'text',
                                'hargaBarang',
                                '',
                                [
                                    'class'=>'form-control hargaBarang',
                                    'data-penawaran-id'=>$model_id,
                                    'data-permintaan-detail-id'=>$data->id,
                                    'id'=>'hargaBarang-' . $data->id,
                                ]
                            );
                        },
                        'format'=>'raw'
                    ],
                ],
            ]);

            ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="js:savePenawaranDetail()">Simpan Hasil Penawaran</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="viewPenawaranModal" tabindex="-1" role="dialog" aria-labelledby="viewPenawaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="viewPenawaranModalLabel">Order Barang</h2>
            </div>
            <div class="modal-body">
                <?php
                $model_id = $model->id;
                echo GridView::widget([
                    'dataProvider' => $detailProvider,
                    'columns' => [
                        'permintaanDetail.barang.nama',
                        'permintaanDetail.barang.jenis',
                        'permintaanDetail.jumlah',
                        'harga_penawaran:raw:Harga yang ditawarkan',
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


<!-- Modal -->
<div class="modal fade" id="ubahStatusModal" tabindex="-1" role="dialog" aria-labelledby="ubahStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="ubahStatusModalLabel">Ubah Status Penawaran</h2>
            </div>
            <div class="modal-body">
                <div class='form-group'>
                    <?php
                        echo Html::dropDownList(
                            'ubahStatus', 
                            null, 
                            [
                                ''=>'-- Pilih Status --',
                                'Approve'=>'Approve',
                                'Batal'=>'Batal'
                            ],
                            [
                                'class'=>'form-control',
                                'id'=>'ubahStatus',
                                'data-penawaran-id'=>$model->id
                            ]
                        )
                    ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="js:ubahStatus()">Ubah Status</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function savePenawaranDetail() {
        var data = document.getElementsByClassName("hargaBarang");
        var i;
        for (i = 0; i < data.length; i++) {
            // alert($('#' + data[i].id).data('penawaran-id'));
            $.ajax({
                type:'POST',
                dataType:'JSON',
                data: {
                    penawaran_id: $('#' + data[i].id).data('penawaran-id'),
                    permintaan_detail_id: $('#' + data[i].id).data('permintaan-detail-id'),
                    harga_penawaran: $('#' + data[i].id).val(),
                },
                url: window.location.origin + '/penawaran/savepenawarandetail',
                success: function(res) {
                    console.log(res);
                    var message = res.message;
                }
            });
        }

        $('#hasilPenawaranModal').modal('hide');
        location.reload();
    }

    function ubahStatus() {
        var newStatus = $('#ubahStatus').val();

        if (newStatus != '') {
            $.ajax({
                type:'POST',
                dataType:'JSON',
                data: {
                    id: $('#ubahStatus').data('penawaran-id'),
                    status: newStatus,
                },
                url: window.location.origin + '/penawaran/ubahstatus',
                success: function(res) {
                    $('#ubahStatusModal').modal('hide');
                    alert(res.message);
                    location.reload();
                }
            });

        }
    }
</script>