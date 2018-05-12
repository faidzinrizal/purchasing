<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pemesanan;

/**
 * PemesananSearch represents the model behind the search form about `app\models\Pemesanan`.
 */
class PemesananSearch extends Pemesanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'penawaran_id', 'jumlah_tagihan'], 'integer'],
            [['no_surat', 'tanggal', 'tanggal_penerimaan'], 'safe'],
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
        $query = Pemesanan::find();

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
            'penawaran_id' => $this->penawaran_id,
            'tanggal' => $this->tanggal,
            'tanggal_penerimaan' => $this->tanggal_penerimaan,
            'jumlah_tagihan' => $this->jumlah_tagihan,
        ]);

        $query->andFilterWhere(['like', 'no_surat', $this->no_surat]);

        return $dataProvider;
    }
}
