<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenawaranDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penawaran Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penawaran-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Penawaran Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'penawaran_id',
            'permintaan_detail_id',
            'harga_penawaran',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
