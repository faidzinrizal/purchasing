
<?php
use yii\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'no_surat',
        'penawaran.no_surat:raw:No Surat Penawaran',
        'penawaran.supplier.nama:raw:Nama Supplier',
        [
            'label' => 'Tanggal Pemesanan',
            'value' => function($data) {
                return date('d-m-Y', strtotime($data->tanggal));
            },
        ],
        [
            'label' => 'Tanggal Penawaran',
            'value' => function($data) {
                return date('d-m-Y', strtotime($data->penawaran->tanggal));
            },
        ],
        [
            'label' => 'Tanggal Penerimaan',
            'value' => function($data) {
                return date('d-m-Y', strtotime($data->tanggal_penerimaan));
            },
        ],
        [
            'label' => 'Jumlah Tagihan',
            'value' => function($data) {
                return "Rp. " . number_format($data->jumlah_tagihan,2,',','.');;
            },
        ],
    ],
]); ?>