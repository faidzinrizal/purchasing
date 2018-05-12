<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Penawaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class='row'>

    </div>

    <?php Pjax::begin(['id'=>'gv-penawaran']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_surat',
            'permintaan.no_permintaan',
            'supplier.nama',
            'tanggal',
            'status'
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
