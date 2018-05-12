<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $kota
 * @property string $telepon
 *
 * @property Penawaran[] $penawarans
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'alamat'], 'string', 'max' => 100],
            [['kota', 'telepon'], 'string', 'max' => 50],
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
            'alamat' => 'Alamat',
            'kota' => 'Kota',
            'telepon' => 'Telepon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPenawarans()
    {
        return $this->hasMany(Penawaran::className(), ['supplier_id' => 'id']);
    }
}
