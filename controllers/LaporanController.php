<?php

namespace app\controllers;

use Yii;
use app\models\Penawaran;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PembayaranController implements the CRUD actions for Pembayaran model.
 */
class LaporanController extends Controller
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

    public function actionPenawaran()
    {
        $model = new Penawaran;

        $dataProvider = $this->actionGetData();
        return $this->render('penawaran', get_defined_vars());
    }

    public function actionGetData()
    {
        $post = Yii::$app->request->post();

        $query = Penawaran::find();
        if ($post) {
            // // grid filtering conditions
            // $query->andFilterWhere([
            //     'id' => $post['id'],
            //     'permintaan_id' => $post['permintaan_id'],
            //     'supplier_id' => $post['supplier_id'],
            //     'tanggal' => $post['tanggal'],
            // ]);
    
            // $query->andFilterWhere(['like', 'no_surat', $post['no_surat']])
            //     ->andFilterWhere(['like', 'status', $post['status']]);
        }



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);
        return $dataProvider;
    }

}
