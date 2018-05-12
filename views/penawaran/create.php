<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Penawaran */

$this->title = 'Create Penawaran';
$this->params['breadcrumbs'][] = ['label' => 'Penawarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penawaran-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'listData' => $listData,
        'dataProviderBarang' => $dataProviderBarang,
    ]) ?>

</div>
