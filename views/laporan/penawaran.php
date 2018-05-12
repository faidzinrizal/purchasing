<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\web\View;

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
        <div class='col-md-3'>
            <?= Html::textInput('Periode', '', ['class'=>'form-control', 'id'=>'dari', 'placeholder'=>'Periode']); ?>
        </div>
        <div class='col-md-3'>
            <?= Html::textInput('No surat', '', ['class'=>'form-control', 'id'=>'no_surat']); ?>
        </div>
        <div class='col-md-3'>
            <?= Html::textInput('No Permintaan', '', ['class'=>'form-control', 'id'=>'no_permintaan']); ?>
        </div>
        <div class='col-md-3'>
            <?= Html::textInput('Nama Supplier', '', ['class'=>'form-control', 'id'=>'nama_supplier']); ?>
        </div>
    </div>

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
</div>

<script>
</script>


<?php
$this->registerJs(
    "
    $( document ).ready(function() {
        $('#periode').datepicker();
    });
    ",
    View::POS_READY
);


