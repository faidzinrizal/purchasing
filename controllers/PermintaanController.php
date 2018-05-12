<?php

namespace app\controllers;

use Yii;
use app\models\Permintaan;
use app\models\Barang;
use app\models\PermintaanDetail;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use app\models\PermintaanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Session;
use yii\filters\VerbFilter;

/**
 * PermintaanController implements the CRUD actions for Permintaan model.
 */
class PermintaanController extends Controller
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
     * Lists all Permintaan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PermintaanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Permintaan model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Permintaan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Permintaan();
        $model->tanggal = date('d-m-Y');
        $session = Yii::$app->session;

        $barang = Barang::find();
        $barangProvider = new ActiveDataProvider([
            'query'=>$barang,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if ($model->load(Yii::$app->request->post())) {
            $model->tanggal = date('Y-m-d', strtotime($model->tanggal));
            $model->save();
            foreach ($session['addBarang'] as $each) {
                $permintaanDetail = new PermintaanDetail();
                $permintaanDetail->permintaan_id = $model->id;
                $permintaanDetail->barang_id = $each['id'];
                $permintaanDetail->jumlah = $each['jumlah'];
                $permintaanDetail->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            $session['addBarang'] = []; 

            $query = $session['addBarang'];
            $dataProvider = new ArrayDataProvider([
                'allModels' => $query,
            ]);
            return $this->render('create', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'barangProvider' => $barangProvider,
            ]);
        }
    }

    /**
     * Updates an existing Permintaan model.
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
     * Deletes an existing Permintaan model.
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
     * Finds the Permintaan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Permintaan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Permintaan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionTambahbarang() {
        $session = Yii::$app->session;
        $id = $_POST['id'];
        $jumlah = $_POST['jumlah'];

        $barang = Barang::findOne($id);
        $sessionBarang = $session['addBarang'];
        if ($barang) {
            $array = [
                'id'=>$barang->id,
                'nama'=>$barang->nama,
                'jumlah'=>$jumlah,
            ];
            array_push($sessionBarang, $array);
            $session['addBarang'] = $sessionBarang;
        }
        $query = $session['addBarang'];
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
        ]);

        return $this->renderAjax('_form_grid_barang', [
            'dataProvider' => $dataProvider,
        ]
        );
    }

    public function actionHapusbarang() {
        $session = Yii::$app->session;
        $id = $_POST['id'];

        $sessionBarang = $session['addBarang'];
        $newData = [];
        foreach ($sessionBarang as $key=>$each) {
            if ($key != $id) {
                $newData[] = $each;
            }
        }

        $session['addBarang'] = $newData;
        $query = $session['addBarang'];
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
        ]);

        return $this->renderAjax('_form_grid_barang', [
            'dataProvider' => $dataProvider,
        ]
        );
    }
}
