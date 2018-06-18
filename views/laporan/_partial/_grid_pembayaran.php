
<?php
use yii\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => 'Tanggal Pembayaran',
            'value' => function($data) {
                return date('d-m-Y', strtotime($data->tanggal));
            },
        ],
        'pemesanan.no_surat:raw:No Surat Pemesanan',
        'pemesanan.penawaran.supplier.nama:raw:Nama Supplier',
        [
            'label' => 'Jumlah Pembayaran',
            'value' => function($data) {
                return "Rp. " . number_format($data->jumlah_bayar,2,',','.');;
            },
        ],
        [
            'label' => 'Sisa Tagihan',
            'value' => function($data) {
                return "Rp. " . number_format($data->sisa_tagihan,2,',','.');;
            },
        ],
        'keterangan'
    ],
]); ?>