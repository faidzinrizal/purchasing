<?php

namespace app\controllers;

use Yii;
use app\models\Pemesanan;
use app\models\Penawaran;
use app\models\Pembayaran;
use app\models\PemesananSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PemesananController implements the CRUD actions for Pemesanan model.
 */
class PemesananController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all Pemesanan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PemesananSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pemesanan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $pembayaran = new Pembayaran();
        $pembayaran->tanggal = date('d-m-Y');

        $historyPembayaran = $model->pembayarans;
        $sisaTagihan = $model->jumlah_tagihan; 
        foreach ($historyPembayaran as $each) {
            $sisaTagihan -= $each->jumlah_bayar;
        }

        return $this->render('view', [
            'model' => $model,
            'pembayaran'=>$pembayaran,
            'sisaTagihan'=>$sisaTagihan
        ]);
    }

    /**
     * Creates a new Pemesanan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($penawaran_id)
    {
        $model = new Pemesanan();
        $model->tanggal = date('d-m-Y');
        $penawaran = Penawaran::findOne($penawaran_id);
        $model->penawaran_id = $penawaran->id;

        $tagihan = 0;
        foreach ($penawaran->penawaranDetails as $penawaranDetail) {
            $tagihan += $penawaranDetail->harga_penawaran;
        }
        $model->jumlah_tagihan = $tagihan;

        if ($model->load(Yii::$app->request->post())) {
            $model->tanggal = date('Y-m-d', strtotime($model->tanggal));
            $model->tanggal_penerimaan = date('Y-m-d', strtotime($model->tanggal_penerimaan));
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'penawaran' => $penawaran,
            ]);
        }
    }

    /**
     * Updates an existing Pemesanan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pemesanan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pemesanan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pemesanan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pemesanan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionSimpanpembayaran() {
        $pemesanan_id = $_POST['pemesanan_id'];
        // $tanggal = $_POST['tanggal'];
        $keterangan = $_POST['keterangan'];
        $jumlah_bayar = $_POST['jumlah_bayar'];
        $sisa_tagihan = $_POST['sisa_tagihan'];

        $pembayaran = new Pembayaran();
        $pembayaran->pemesanan_id = $pemesanan_id;
        $pembayaran->tanggal = date('Y-m-d');
        $pembayaran->keterangan = $keterangan;
        $pembayaran->jumlah_bayar = $jumlah_bayar;
        $pembayaran->sisa_tagihan = $sisa_tagihan;
        $pembayaran->save();

        $result = [
            'code'=>200,
            'message'=>'Data berhasil disimpan.'
        ];
        echo json_encode($result);
    }
}
