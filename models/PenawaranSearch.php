<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Penawaran;

/**
 * PenawaranSearch represents the model behind the search form about `app\models\Penawaran`.
 */
class PenawaranSearch extends Penawaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'permintaan_id', 'supplier_id'], 'integer'],
            [['no_surat', 'tanggal', 'status'], 'safe'],
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
        $query = Penawaran::find();

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
            'supplier_id' => $this->supplier_id,
            'tanggal' => $this->tanggal,
        ]);

        $query->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
