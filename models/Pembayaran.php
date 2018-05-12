<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pembayaran".
 *
 * @property integer $id
 * @property integer $pemesanan_id
 * @property string $tanggal
 * @property string $keterangan
 * @property integer $jumlah_bayar
 * @property integer $sisa_tagihan
 *
 * @property Pemesanan $pemesanan
 */
class Pembayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pembayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemesanan_id'], 'required'],
            [['pemesanan_id', 'jumlah_bayar', 'sisa_tagihan'], 'integer'],
            [['tanggal'], 'safe'],
            [['keterangan'], 'string', 'max' => 100],
            [['pemesanan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pemesanan::className(), 'targetAttribute' => ['pemesanan_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pemesanan_id' => 'Pemesanan ID',
            'tanggal' => 'Tanggal',
            'keterangan' => 'Keterangan',
            'jumlah_bayar' => 'Jumlah Bayar',
            'sisa_tagihan' => 'Sisa Tagihan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemesanan()
    {
        return $this->hasOne(Pemesanan::className(), ['id' => 'pemesanan_id']);
    }
}
