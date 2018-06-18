<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\web\View;
use yii\jui\DatePicker;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PembayaranSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Permintaan Barang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class='row'>
        <div class='col-md-4'>
            <?php
            echo '<label class="control-label">Periode</label>';
            echo '<div class="input-group drp-container" style="width:100%">';
            echo DateRangePicker::widget([
                'name'=>'date_range_1',
                'id'=>'periode',
                'convertFormat'=>true,
                'useWithAddon'=>true,
                'pluginOptions'=>[
                    'locale'=>[
                        'format'=>'d-m-Y',
                        'separator'=>' s.d ',
                    ],
                    'opens'=>'right'
                ]
            ]);
            echo '</div>';
            ?>
        </div>
        <div class='col-md-4'>
            <?php
            echo '<label class="control-label">No Permintaan</label>';
            echo Html::textInput('No Permintaan', '', ['class'=>'form-control', 'id'=>'no_permintaan']); 
            ?>
        </div>
        <div class='col-md-4'>
            <?php
            echo '<label class="control-label">Status</label>';
            echo Html::DropDownList(
                'Status', 
                [],
                [
                    'Pending'=>'Pending',
                    'Approve'=>'Approve',
                    'Batal'=>'Batal',
                ], 
                ['class'=>'form-control','prompt'=>'--Pilih--', 'id'=>'status']
            ); 
            ?>
        </div>
    </div>
    
    <br>
    <div class='row'>
        <div class='col-md-12'>
            <button class='btn btn-primary cari'>Cari</button>
        </div>
    </div>
    <br>

    <div class='gv-permintaan'>
    </div>
</div>


<?php
$this->registerJs(
    "
    $( document ).ready(function() {
        $('.cari').trigger('click');
    });

    $('.cari').click(function() {
        $.ajax({
            type:'POST',
            dataType: 'html',
            data: {
                periode: $('#periode').val(),
                no_permintaan: $('#no_permintaan').val(),
                status: $('#status').val(),
            },
            url: '" . Url::to(['laporan/grid-permintaan']) . "',
            success: function(res) {
                $('.gv-permintaan').html(res);
            }
        });
    });
    ",
    View::POS_READY
);


