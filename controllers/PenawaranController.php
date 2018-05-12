<?php

namespace app\controllers;

use Yii;
use app\models\Penawaran;
use app\models\Permintaan;
use app\models\PermintaanDetail;
use app\models\PenawaranDetail;
use app\models\Supplier;
use app\models\PenawaranSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * PenawaranController implements the CRUD actions for Penawaran model.
 */
class PenawaranController extends Controller
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
     * Lists all Penawaran models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenawaranSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penawaran model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $listBarang = PermintaanDetail::find()->where(['permintaan_id' => $model->permintaan_id]);
        $orderProvider = new ActiveDataProvider([
            'query'=>$listBarang,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        $penawaranDetails = PenawaranDetail::find()->where(['penawaran_id' => $model->id]);
        $detailProvider = new ActiveDataProvider([
            'query'=>$penawaranDetails,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('view', [
            'model' => $model,
            'orderProvider' => $orderProvider,
            'detailProvider' => $detailProvider,
        ]);
    }

    /**
     * Creates a new Penawaran model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_permintaan)
    {
        $model = new Penawaran();
        $permintaan = Permintaan::findOne($id_permintaan);
        $model->status = 'Pengajuan';
        $model->permintaan_id = $permintaan->id;
        
        $listBarang = PermintaanDetail::find()->where(['permintaan_id' => $id_permintaan]);
        $dataProviderBarang = new ActiveDataProvider([
            'query'=>$listBarang,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $supplier = Supplier::find()->all();
        $listData = ArrayHelper::map($supplier,'id','nama');

        if ($model->load(Yii::$app->request->post())) {
            $model->tanggal = date('Y-m-d', strtotime($model->tanggal));
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'listData' => $listData,
                'dataProviderBarang' => $dataProviderBarang,
            ]);
        }
    }

    /**
     * Updates an existing Penawaran model.
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
     * Deletes an existing Penawaran model.
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
     * Finds the Penawaran model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penawaran the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penawaran::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionSavepenawarandetail() {
        $penawaran_id = $_POST['penawaran_id'];
        $permintaan_detail_id = $_POST['permintaan_detail_id'];
        $harga_penawaran = $_POST['harga_penawaran'];

        $penawaranDetail = new PenawaranDetail();
        $penawaranDetail->penawaran_id = $penawaran_id;
        $penawaranDetail->permintaan_detail_id = $permintaan_detail_id;
        $penawaranDetail->harga_penawaran = $harga_penawaran;
        $penawaranDetail->save();

        $penawaran = Penawaran::findOne($penawaran_id);
        $penawaran->status = 'Pending';
        $penawaran->save();

        $result = [
            'code'=>200,
            'message'=>'Data berhasil disimpan.'
        ];
        echo json_encode($result);
    }

    public function actionUbahstatus() {
        $id = $_POST['id'];
        $status = $_POST['status'];

        $penawaran = Penawaran::findOne($id);
        $penawaran->status = $status;
        $penawaran->save();

        if($status == 'Approve') {
            $permintaan = Permintaan::findOne($penawaran->permintaan_id);
            $permintaan->status = 'Approve';
            $permintaan->save();
        }

        $result = [
            'code'=>200,
            'message'=>'Data berhasil disimpan.'
        ];
        echo json_encode($result);
    }
}
