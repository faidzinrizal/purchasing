<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\web\View;
use yii\jui\DatePicker;

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Pemesanan */

$this->title = $model->no_surat;
$this->params['breadcrumbs'][] = ['label' => 'Pemesanans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemesanan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php
        if ($sisaTagihan > 0) {
            echo Html::button(
                'Input Pembayaran', 
                [ 
                    'data-toggle'=>'modal',
                    'data-target'=>'#inputPembayaranModal',
                    'class'=>'btn btn-primary'
                ]
            );
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'no_surat',
            'tanggal',
            'tanggal_penerimaan',
            'penawaran.supplier.nama:raw:Nama Supplier',
            'jumlah_tagihan',
        ],
    ]) ?>

    <h3>History Pembayaran</h3>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jumlah Bayar</th>
                <th>Sisa Tagihan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($model->pembayarans) : ?>
                <?php foreach ($model->pembayarans as $each): ?>
                    <tr>
                        <td><?= date('d-m-Y', strtotime($each->tanggal)); ?></td>
                        <td><?= $each->keterangan; ?></td>
                        <td><?= $each->jumlah_bayar; ?></td>
                        <td><?= $each->sisa_tagihan; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan=4>Belum ada history pembayaran</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<!-- Modal -->
<?php $form = ActiveForm::begin(); ?>
<div class="modal fade" id="inputPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="inputPembayaranModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="inputPembayaranModalLabel">Input Pembayaran</h2>
            </div>
            <div class="modal-body">
            <?php
            $model_id = $model->id;
            ?>

            <div class="pembayaran-form">

            <?= $form->field($pembayaran, 'pemesanan_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
            <?= $form->field($model, 'no_surat')->textInput(['value'=>$model->no_surat, 'readonly'=>true]) ?>

            <?= $form->field($model,'tanggal', ['inputOptions'=>['class'=>'form-control', 'disabled'=>'disabled']])->label('Tanggal Pemesanan'); ?>

            <?= $form->field($pembayaran, 'keterangan')->textInput(['maxlength' => true]) ?>

            <?= $form->field($pembayaran, 'jumlah_bayar')->textInput() ?>

            <?= 
                Html::hiddenInput(
                    'tagihanAwal',
                    $sisaTagihan,
                    [
                        'class'=>'form-control',
                        'id'=>'tagihanAwal',
                    ]
                );

            ?>

            <?= $form->field($pembayaran, 'sisa_tagihan')->textInput(['value'=>$sisaTagihan]) ?>



        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="js:savePembayaran()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<script type="text/javascript">
    
    function savePembayaran() {
        var pemesanan_id = $('#pembayaran-pemesanan_id').val();
        var tanggal = $('#pembayaran-tanggal').val();
        var keterangan = $('#pembayaran-keterangan').val();
        var jumlah_bayar = $('#pembayaran-jumlah_bayar').val();
        var sisa_tagihan = $('#pembayaran-sisa_tagihan').val();

        $.ajax({
            type:'POST',
            dataType:'JSON',
            data: {
                pemesanan_id: pemesanan_id,
                tanggal: tanggal,
                keterangan: keterangan,
                jumlah_bayar: jumlah_bayar,
                sisa_tagihan: sisa_tagihan,
            },
            url: '<?= Url::to(['pemesanan/simpanpembayaran']); ?>',
            success: function(res) {
                $('#inputPembayaranModal').modal('hide');
                alert(res.message);
                location.reload();
            }
        });
    }
</script>

<?php
$this->registerJs(
    "
    $( document ).ready(function() {
        $('#pembayaran-jumlah_bayar').keyup(function() {
            var jumlahBayar = $(this).val();
            var tagihanAwal = $('#tagihanAwal').val();

            $('#pembayaran-sisa_tagihan').val(tagihanAwal - jumlahBayar);
        });
    });
    ",
    View::POS_READY
);