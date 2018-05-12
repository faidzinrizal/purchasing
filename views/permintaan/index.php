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
                'template' => '{lihat}{buatPenawaran}',
                'buttons' => [
                    'lihat' => function($url, $model, $key) {
                        return Html::a(
                        'Lihat',
                        Url::to(['view', 'id'=> $model->id]),
                        [ 
                            'class'=>'btn btn-info btn-sm',
                        ]);
                    },
                    'buatPenawaran' => function($url, $model, $key) {
                        return Html::a(
                        'Buat Penawaran',
                        Url::to(['penawaran/create', 'id_permintaan'=> $model->id]),
                        [ 
                            'class'=>'btn btn-primary btn-sm',
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
