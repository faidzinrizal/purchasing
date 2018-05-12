<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pembayarans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pembayaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pembayaran', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pemesanan_id',
            'tanggal',
            'keterangan',
            'jumlah_bayar',
            // 'sisa_tagihan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
