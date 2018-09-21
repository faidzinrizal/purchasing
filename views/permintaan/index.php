<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PermintaanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Permintaan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permintaan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'no_permintaan',
            'deskripsi',
            'tanggal',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{lihat}{buatPenawaran}{hapus}',
                'buttons' => [
                    'lihat' => function($url, $model, $key) {
                        return Html::a(
                        'Lihat',
                        Url::to(['view', 'id'=> $model->id]),
                        [ 
                            'class'=>'btn btn-info btn-sm',
                            'style'=>'margin-right: 5px;'
                        ]);
                    },
                    'buatPenawaran' => function($url, $model, $key) {
                        return Html::a(
                        'Buat Penawaran',
                        Url::to(['penawaran/create', 'id_permintaan'=> $model->id]),
                        [ 
                            'class'=>'btn btn-primary btn-sm',
                            'style'=>'margin-right: 5px;'
                        ]);
                    },
                    'hapus' => function($url, $model, $key) {
                        return Html::a(
                        'Hapus',
                        Url::to(['delete', 'id'=> $model->id]),
                        [ 
                            'class'=>'btn btn-danger btn-sm',
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            'data-method' => 'post',
                            'style' => $model->penawarans ? "display: none;" : "",
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
