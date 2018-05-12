<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Permintaan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Permintaans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permintaan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'no_permintaan',
            'deskripsi',
            'tanggal',
            'status',
        ],
    ]) ?>

    <h4>Data Barang</h4>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($model->permintaanDetails): ?>
                <?php foreach ($model->permintaanDetails as $key => $detail) : ?>
                    <tr>
                        <td><?= $detail->barang->nama; ?></td>
                        <td><?= $detail->jumlah; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Data Kosong</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
