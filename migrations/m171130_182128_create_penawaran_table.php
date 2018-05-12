<?php

use yii\db\Migration;

/**
 * Handles the creation of table `penawaran`.
 * Has foreign keys to the tables:
 *
 * - `permintaan`
 * - `supplier`
 */
class m171130_182128_create_penawaran_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('penawaran', [
            'id' => $this->primaryKey(),
            'permintaan_id' => $this->integer()->notNull(),
            'supplier_id' => $this->integer()->notNull(),
            'no_surat' => $this->string(50),
            'tanggal' => $this->date(),
            'status' => $this->string(50)->defaultValue('pending'),
        ]);

        // creates index for column `permintaan_id`
        $this->createIndex(
            'idx-penawaran-permintaan_id',
            'penawaran',
            'permintaan_id'
        );

        // add foreign key for table `permintaan`
        $this->addForeignKey(
            'fk-penawaran-permintaan_id',
            'penawaran',
            'permintaan_id',
            'permintaan',
            'id',
            'CASCADE'
        );

        // creates index for column `supplier_id`
        $this->createIndex(
            'idx-penawaran-supplier_id',
            'penawaran',
            'supplier_id'
        );

        // add foreign key for table `supplier`
        $this->addForeignKey(
            'fk-penawaran-supplier_id',
            'penawaran',
            'supplier_id',
            'supplier',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `permintaan`
        $this->dropForeignKey(
            'fk-penawaran-permintaan_id',
            'penawaran'
        );

        // drops index for column `permintaan_id`
        $this->dropIndex(
            'idx-penawaran-permintaan_id',
            'penawaran'
        );

        // drops foreign key for table `supplier`
        $this->dropForeignKey(
            'fk-penawaran-supplier_id',
            'penawaran'
        );

        // drops index for column `supplier_id`
        $this->dropIndex(
            'idx-penawaran-supplier_id',
            'penawaran'
        );

        $this->dropTable('penawaran');
    }
}
