
<?php
use yii\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'no_permintaan',
        'tanggal',
        'deskripsi',
        'status'
    ],
]); ?>