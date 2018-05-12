<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property integer $id
 * @property string $nama
 * @property string $jenis
 *
 * @property PermintaanDetail[] $permintaanDetails
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'string', 'max' => 100],
            [['jenis'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'jenis' => 'Jenis',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermintaanDetails()
    {
        return $this->hasMany(PermintaanDetail::className(), ['barang_id' => 'id']);
    }
}
