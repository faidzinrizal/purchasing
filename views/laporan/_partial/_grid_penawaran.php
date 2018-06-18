
<?php
use yii\widgets\Pjax;
use yii\grid\GridView;
?>

<?php Pjax::begin(['id'=>'gv-penawaran']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_surat',
            'permintaan.no_permintaan',
            'tanggal',
            'supplier.nama:raw:Nama Supplier',
            'status'
        ],
    ]); ?>
<?php Pjax::end(); ?>