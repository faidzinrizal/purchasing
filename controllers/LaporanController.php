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
        $query = $model->find();

        // // grid filtering conditions
        // $query->andFilterWhere([
        //     'id' => $this->id,
        //     'permintaan_id' => $this->permintaan_id,
        //     'supplier_id' => $this->supplier_id,
        //     'tanggal' => $this->tanggal,
        // ]);

        // $query->andFilterWhere(['like', 'no_surat', $this->no_surat])
        //     ->andFilterWhere(['like', 'status', $this->status]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        return $this->render('penawaran', get_defined_vars());
    }

    public function actionGetData()
    {
        $post = Yii::$app->request->post();

        $query = Penawaran::find();

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $post['id'],
            'permintaan_id' => $post['permintaan_id'],
            'supplier_id' => $post['supplier_id'],
            'tanggal' => $post['tanggal'],
        ]);

        $query->andFilterWhere(['like', 'no_surat', $post['no_surat']])
            ->andFilterWhere(['like', 'status', $post['status']]);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);
        return $dataProvider;
    }

}
