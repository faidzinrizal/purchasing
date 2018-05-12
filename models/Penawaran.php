<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penawaran".
 *
 * @property integer $id
 * @property integer $permintaan_id
 * @property integer $supplier_id
 * @property string $no_surat
 * @property string $tanggal
 * @property string $status
 *
 * @property Pemesanan[] $pemesanans
 * @property Permintaan $permintaan
 * @property Supplier $supplier
 * @property PenawaranDetail[] $penawaranDetails
 */
class Penawaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'penawaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permintaan_id', 'supplier_id'], 'required'],
            [['permintaan_id', 'supplier_id'], 'integer'],
            [['tanggal'], 'safe'],
            [['no_surat', 'status'], 'string', 'max' => 50],
            [['permintaan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Permintaan::className(), 'targetAttribute' => ['permintaan_id' => 'id']],
            [['supplier_id'], 'exist', 'skipOnError' => true, 'targetClass' => Supplier::className(), 'targetAttribute' => ['supplier_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'permintaan_id' => 'Permintaan',
            'supplier_id' => 'Supplier',
            'no_surat' => 'No Surat',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPemesanans()
    {
        return $this->hasMany(Pemesanan::className(), ['penawaran_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermintaan()
    {
        return $this->hasOne(Permintaan::className(), ['id' => 'permintaan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupplier()
    {
        return $this->hasOne(Supplier::className(), ['id' => 'supplier_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenawaranDetails()
    {
        return $this->hasMany(PenawaranDetail::className(), ['penawaran_id' => 'id']);
    }
}
