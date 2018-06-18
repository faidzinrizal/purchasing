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

$this->title = 'Laporan Pemesanan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <div class='row'>
        <div class='col-md-3'>
            <?php
            echo '<label class="control-label">Periode Pemesanan</label>';
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
        <div class='col-md-3'>
            <?php
            echo '<label class="control-label">Periode Penawaran</label>';
            echo '<div class="input-group drp-container" style="width:100%">';
            echo DateRangePicker::widget([
                'name'=>'date_range_1',
                'id'=>'periode_penawaran',
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
        
        <div class='col-md-3'>
            <?php
            echo '<label class="control-label">Nama Supplier</label>';
            echo Html::textInput('Nama Supplier', '', ['class'=>'form-control', 'id'=>'nama_supplier']); 
            ?>
        </div>
        <div class='col-md-3'>
            <?php
            echo '<label class="control-label">No Surat</label>';
            echo Html::textInput('No surat', '', ['class'=>'form-control', 'id'=>'no_surat']); 
            ?>
        </div>
        <div class='col-md-3'>
            <?php
            echo '<label class="control-label">No Surat Penawaran</label>';
            echo Html::textInput('No surat penawaran', '', ['class'=>'form-control', 'id'=>'no_surat_penawaran']); 
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

    <div class='gv-pemesanan'>
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
                periode_penawaran: $('#periode_penawaran').val(),
                nama_supplier: $('#nama_supplier').val(),
                no_surat: $('#no_surat').val(),
                no_surat_penawaran: $('#no_surat_penawaran').val(),
                status: $('#status').val(),
            },
            url: '" . Url::to(['laporan/grid-pemesanan']) . "',
            success: function(res) {
                $('.gv-pemesanan').html(res);
            }
        });
    });
    ",
    View::POS_READY
);


