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
            'permintaan_id',
            'supplier.nama',
            'no_surat',
            'tanggal',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{lihatPermintaan}{lihat}{tambahPemesanan}',
                'buttons' => [
                    'lihat' => function($url, $model, $key) {
                        return Html::a(
                        'Lihat Penawaran',
                        Url::to(['view', 'id' => $model->id]),
                        [ 
                            'class'=>'btn btn-info btn-sm',
                        ]);
                    },
                    'lihatPermintaan' => function($url, $model, $key) {
                        return Html::a(
                        'Lihat Permintaan',
                        Url::to(['permintaan/view', 'id' => $model->permintaan->id]),
                        [ 
                            'class'=>'btn btn-primary btn-sm',
                        ]);
                    },
                    'tambahPemesanan' => function($url, $model, $key) {
                        $return = Html::a(
                        'Tambah Pemesanan',
                        Url::to(['pemesanan/create', 'penawaran_id' => $model->id]),
                        [ 
                            'class'=>'btn btn-success btn-sm',
                        ]);

                        if ($model->pemesanans) {
                            $return = Html::a(
                            'Lihat Pemesanan',
                            Url::to(['pemesanan/view', 'id'=>$model->pemesanans[0]->id]),
                            [ 
                                'class'=>'btn btn-success btn-sm',
                            ]);
                        }
                        if ($model->status == 'Approve') {
                            return $return; 
                        } else {
                            return '';
                        }
                    }
                ]
            ],
        ],
    ]); ?>
</div>
