<?php

use yii\db\Migration;

/**
 * Handles the creation of table `permintaan`.
 */
class m171130_180655_create_permintaan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('permintaan', [
            'id' => $this->primaryKey(),
            'no_permintaan' => $this->string(50),
            'deskripsi' => $this->string(100),
            'tanggal' => $this->date(),
            'status' => $this->string(50)->defaultValue('pending'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('permintaan');
    }
}
