<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenawaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penawaran';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penawaran-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'permintaan_id',
            'supplier.nama',
            'no_surat',
            'tanggal',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{lihatPermintaan}{lihat}{tambahPemesanan}{hapus}',
                'buttons' => [
                    'lihat' => function($url, $model, $key) {
                        return Html::a(
                        'Lihat Penawaran',
                        Url::to(['view', 'id' => $model->id]),
                        [ 
                            'class'=>'btn btn-info btn-sm',
                            'style'=>'margin-right: 5px;'
                        ]);
                    },
                    'lihatPermintaan' => function($url, $model, $key) {
                        return Html::a(
                        'Lihat Permintaan',
                        Url::to(['permintaan/view', 'id' => $model->permintaan->id]),
                        [ 
                            'class'=>'btn btn-primary btn-sm',
                            'style'=>'margin-right: 5px;'
                        ]);
                    },
                    'tambahPemesanan' => function($url, $model, $key) {
                        $return = Html::a(
                        'Tambah Pemesanan',
                        Url::to(['pemesanan/create', 'penawaran_id' => $model->id]),
                        [ 
                            'class'=>'btn btn-success btn-sm',
                        ]);
                        // $return   = '';

                        if ($model->pemesanans) {
                            $return = Html::a(
                            'Lihat Pemesanan',
                            Url::to(['pemesanan/view', 'id'=>$model->pemesanans[0]->id]),
                            [ 
                                'class'=>'btn btn-success btn-sm',
                                'style'=>'margin-right: 5px;'
                            ]);
                        }
                        if ($model->status == 'Approve') {
                            return $return; 
                        } else {
                            return '';
                        }
                    },
                    'hapus' => function($url, $model, $key) {
                        return Html::a(
                        'Hapus',
                        Url::to(['delete', 'id'=> $model->id]),
                        [ 
                            'class'=>'btn btn-danger btn-sm',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'style' => $model->penawaranDetails ? "display: none;" : "",
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
