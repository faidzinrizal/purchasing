<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permintaan_detail".
 *
 * @property integer $id
 * @property integer $permintaan_id
 * @property integer $barang_id
 * @property integer $jumlah
 *
 * @property PenawaranDetail[] $penawaranDetails
 * @property Barang $barang
 * @property Permintaan $permintaan
 */
class PermintaanDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permintaan_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permintaan_id', 'barang_id'], 'required'],
            [['permintaan_id', 'barang_id', 'jumlah'], 'integer'],
            [['barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['barang_id' => 'id']],
            [['permintaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Permintaan::className(), 'targetAttribute' => ['permintaan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permintaan_id' => 'Permintaan ID',
            'barang_id' => 'Barang ID',
            'jumlah' => 'Jumlah',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenawaranDetails()
    {
        return $this->hasMany(PenawaranDetail::className(), ['permintaan_detail_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'barang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermintaan()
    {
        return $this->hasOne(Permintaan::className(), ['id' => 'permintaan_id']);
    }
}
