<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pemesanan".
 *
 * @property integer $id
 * @property integer $penawaran_id
 * @property string $no_surat
 * @property string $tanggal
 * @property string $tanggal_penerimaan
 * @property integer $jumlah_tagihan
 *
 * @property Penawaran $penawaran
 */
class Pemesanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pemesanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penawaran_id'], 'required'],
            [['penawaran_id', 'jumlah_tagihan'], 'integer'],
            [['tanggal', 'tanggal_penerimaan'], 'safe'],
            [['no_surat'], 'string', 'max' => 50],
            [['penawaran_id'], 'exist', 'skipOnError' => true, 'targetClass' => Penawaran::className(), 'targetAttribute' => ['penawaran_id' => 'id']],
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
            'no_surat' => 'No Surat',
            'tanggal' => 'Tanggal',
            'tanggal_penerimaan' => 'Tanggal Penerimaan',
            'jumlah_tagihan' => 'Jumlah Tagihan',
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
    public function getPembayarans()
    {
        return $this->hasMany(Pembayaran::className(), ['pemesanan_id' => 'id']);
    }
}
