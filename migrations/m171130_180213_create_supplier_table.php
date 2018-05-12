<?php

use yii\db\Migration;

/**
 * Handles the creation of table `supplier`.
 */
class m171130_180213_create_supplier_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('supplier', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(100),
            'alamat' => $this->string(100),
            'kota' => $this->string(50),
            'telepon' => $this->string(50),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('supplier');
    }
}
