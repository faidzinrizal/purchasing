<?php

namespace app\controllers;

use Yii;
use app\models\Penawaran;
use app\models\Permintaan;
use app\models\Pemesanan;
use app\models\Pembayaran;
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
    
    
    public function actionPemesanan()
    {
        return $this->render('pemesanan', get_defined_vars());
    }

    public function actionGridPemesanan()
    {
        $post = Yii::$app->request->post();

        $query = Pemesanan::find()->joinWith('penawaran')->joinWith('penawaran.permintaan')->joinWith('penawaran.supplier');
        if ($post) {
            if ($post['periode']) {
                $periode = explode(' s.d ', $post['periode']);
                $startDate = date('Y-m-d', strtotime($periode[0]));
                $endDate = date('Y-m-d', strtotime($periode[1]));
                $query = $query->andWhere(['between', 'pemesanan.tanggal', $startDate, $endDate]);
            }
            if ($post['periode_penawaran']) {
                $periode = explode(' s.d ', $post['periode_penawaran']);
                $startDate = date('Y-m-d', strtotime($periode[0]));
                $endDate = date('Y-m-d', strtotime($periode[1]));
                $query = $query->andWhere(['between', 'penawaran.tanggal', $startDate, $endDate]);
            }
            if ($post['nama_supplier']) {
                $namaSupplier = $post['nama_supplier'];
                $query = $query->andWhere(['LIKE', 'supplier.nama', $namaSupplier]);
            }
            if ($post['no_surat']) {
                $query = $query->andWhere(['LIKE', 'pemesanan.no_surat', $post['no_surat']]);
            }
            if ($post['no_surat_penawaran']) {
                $query = $query->andWhere(['LIKE', 'penawaran.no_surat', $post['no_surat_penawaran']]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);
        return $this->renderPartial('_partial/_grid_pemesanan', get_defined_vars());
    }



    public function actionPembayaran()
    {
        return $this->render('pembayaran', get_defined_vars());
    }

    public function actionGridPembayaran()
    {
        $post = Yii::$app->request->post();

        $query = Pembayaran::find()
            ->joinWith('pemesanan')
            ->joinWith('pemesanan.penawaran')
            ->joinWith('pemesanan.penawaran.supplier');
        if ($post) {
            if ($post['periode']) {
                $periode = explode(' s.d ', $post['periode']);
                $startDate = date('Y-m-d', strtotime($periode[0]));
                $endDate = date('Y-m-d', strtotime($periode[1]));
                $query = $query->andWhere(['between', 'pembayaran.tanggal', $startDate, $endDate]);
            }
            if ($post['no_surat_pemesanan']) {
                $query = $query->andWhere(['LIKE', 'pemesanan.no_surat', $post['no_surat_pemesanan']]);
            }
            if ($post['nama_supplier']) {
                $namaSupplier = $post['nama_supplier'];
                $query = $query->andWhere(['LIKE', 'supplier.nama', $namaSupplier]);
            }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);
        return $this->renderPartial('_partial/_grid_pembayaran', get_defined_vars());
    }
}
