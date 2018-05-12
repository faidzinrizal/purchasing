<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PermintaanDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Permintaan Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Permintaan Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'permintaan_id',
            'barang_id',
            'jumlah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
