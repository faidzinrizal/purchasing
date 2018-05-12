<?php

use yii\db\Migration;

/**
 * Handles the creation of table `barang`.
 */
class m171130_180323_create_barang_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('barang', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(100),
            'jenis' => $this->string(50),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('barang');
    }
}
