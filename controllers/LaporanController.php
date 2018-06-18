<?php

namespace app\controllers;

use Yii;
use app\models\Penawaran;
use app\models\Permintaan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class LaporanController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionPermintaan()
    {
        return $this->render('permintaan', get_defined_vars());
    }

    public function actionGridPermintaan()
    {
        $post = Yii::$app->request->post();

        $query = Permintaan::find();
        if ($post) {
            if ($post['periode']) {
                $periode = explode(' s.d ', $post['periode']);
                $startDate = date('Y-m-d', strtotime($periode[0]));
                $endDate = date('Y-m-d', strtotime($periode[1]));
                $query = $query->andWhere(['between', 'tanggal', $startDate, $endDate]);
            }
            if ($post['no_permintaan']) {
                $query = $query->andWhere(['LIKE', 'no_permintaan', $post['no_permintaan']]);
            }
            if ($post['status']) {
                $query = $query->andWhere(['status' => $post['status']]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);
        return $this->renderPartial('_partial/_grid_permintaan', get_defined_vars());
    }

    public function actionPenawaran()
    {
        return $this->render('penawaran', get_defined_vars());
    }

    public function actionGridPenawaran()
    {
        $post = Yii::$app->request->post();

        $query = Penawaran::find()->joinWith('supplier');
        if ($post) {
            if ($post['periode']) {
                $periode = explode(' s.d ', $post['periode']);
                $startDate = date('Y-m-d', strtotime($periode[0]));
                $endDate = date('Y-m-d', strtotime($periode[1]));
                $query = $query->andWhere(['between', 'penawaran.tanggal', $startDate, $endDate]);
            }
            if ($post['nama_supplier']) {
                $namaSupplier = $post['nama_supplier'];
                $query = $query->andWhere(['LIKE', 'supplier.nama', $namaSupplier]);
            }
            if ($post['no_surat']) {
                $query = $query->andWhere(['LIKE', 'penawaran.no_surat', $post['no_surat']]);
            }
            if ($post['no_permintaan']) {
                $query = $query->andWhere(['LIKE', 'penawaran.no_permintaan', $post['no_permintaan']]);
            }
            if ($post['status']) {
                $query = $query->andWhere(['penawaran.status' => $post['status']]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);
        return $this->renderPartial('_partial/_grid_penawaran', get_defined_vars());
    }

}
