<?php

use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\grid\GridView;

?>
<div id="gridbarang">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'nama',
            'jumlah',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{tambah}',
                'buttons' => [
                    'tambah' => function($url, $model, $key) {
                        return Html::button(
                        'Hapus', 
                        [
                            'id'=>'Hapus', 
                            'class'=>'btn btn-danger',
                            'onclick'=>"js:ajaxHapusBarang($key);",
                        ]);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
