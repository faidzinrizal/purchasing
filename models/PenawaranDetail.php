<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penawaran_detail".
 *
 * @property integer $id
 * @property integer $penawaran_id
 * @property integer $permintaan_detail_id
 * @property integer $harga_penawaran
 *
 * @property Penawaran $penawaran
 * @property PermintaanDetail $permintaanDetail
 */
class PenawaranDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penawaran_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penawaran_id', 'permintaan_detail_id'], 'required'],
            [['penawaran_id', 'permintaan_detail_id', 'harga_penawaran'], 'integer'],
            [['penawaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penawaran::className(), 'targetAttribute' => ['penawaran_id' => 'id']],
            [['permintaan_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => PermintaanDetail::className(), 'targetAttribute' => ['permintaan_detail_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'penawaran_id' => 'Penawaran ID',
            'permintaan_detail_id' => 'Permintaan Detail ID',
            'harga_penawaran' => 'Harga Penawaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenawaran()
    {
        return $this->hasOne(Penawaran::className(), ['id' => 'penawaran_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermintaanDetail()
    {
        return $this->hasOne(PermintaanDetail::className(), ['id' => 'permintaan_detail_id']);
    }
}
