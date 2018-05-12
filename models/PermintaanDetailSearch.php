<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermintaanDetail;

/**
 * PermintaanDetailSearch represents the model behind the search form about `app\models\PermintaanDetail`.
 */
class PermintaanDetailSearch extends PermintaanDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'permintaan_id', 'barang_id', 'jumlah'], 'integer'],
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
        $query = PermintaanDetail::find();

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
            'permintaan_id' => $this->permintaan_id,
            'barang_id' => $this->barang_id,
            'jumlah' => $this->jumlah,
        ]);

        return $dataProvider;
    }
}
