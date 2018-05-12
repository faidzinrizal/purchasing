<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PemesananSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemesanans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemesanan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemesanan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'penawaran_id',
            'no_surat',
            'tanggal',
            'tanggal_penerimaan',
            // 'jumlah_tagihan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
