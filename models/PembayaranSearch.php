<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pembayaran;

/**
 * PembayaranSearch represents the model behind the search form about `app\models\Pembayaran`.
 */
class PembayaranSearch extends Pembayaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pemesanan_id', 'jumlah_bayar', 'sisa_tagihan'], 'integer'],
            [['tanggal', 'keterangan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Pembayaran::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pemesanan_id' => $this->pemesanan_id,
            'tanggal' => $this->tanggal,
            'jumlah_bayar' => $this->jumlah_bayar,
            'sisa_tagihan' => $this->sisa_tagihan,
        ]);

        $query->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
