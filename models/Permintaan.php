<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permintaan".
 *
 * @property integer $id
 * @property string $no_permintaan
 * @property string $deskripsi
 * @property string $tanggal
 * @property string $status
 *
 * @property Penawaran[] $penawarans
 * @property PermintaanDetail[] $permintaanDetails
 */
class Permintaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permintaan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            [['no_permintaan', 'status'], 'string', 'max' => 50],
            [['deskripsi'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_permintaan' => 'No Permintaan',
            'deskripsi' => 'Deskripsi',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenawarans()
    {
        return $this->hasMany(Penawaran::className(), ['permintaan_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermintaanDetails()
    {
        return $this->hasMany(PermintaanDetail::className(), ['permintaan_id' => 'id']);
    }
}
