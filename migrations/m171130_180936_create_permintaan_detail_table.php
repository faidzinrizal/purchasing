<?php

use yii\db\Migration;

/**
 * Handles the creation of table `permintaan_detail`.
 * Has foreign keys to the tables:
 *
 * - `permintaan`
 * - `barang`
 */
class m171130_180936_create_permintaan_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('permintaan_detail', [
            'id' => $this->primaryKey(),
            'permintaan_id' => $this->integer()->notNull(),
            'barang_id' => $this->integer()->notNull(),
            'jumlah' => $this->integer()->defaultValue(0),
        ]);

        // creates index for column `permintaan_id`
        $this->createIndex(
            'idx-permintaan_detail-permintaan_id',
            'permintaan_detail',
            'permintaan_id'
        );

        // add foreign key for table `permintaan`
        $this->addForeignKey(
            'fk-permintaan_detail-permintaan_id',
            'permintaan_detail',
            'permintaan_id',
            'permintaan',
            'id',
            'CASCADE'
        );

        // creates index for column `barang_id`
        $this->createIndex(
            'idx-permintaan_detail-barang_id',
            'permintaan_detail',
            'barang_id'
        );

        // add foreign key for table `barang`
        $this->addForeignKey(
            'fk-permintaan_detail-barang_id',
            'permintaan_detail',
            'barang_id',
            'barang',
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
            'fk-permintaan_detail-permintaan_id',
            'permintaan_detail'
        );

        // drops index for column `permintaan_id`
        $this->dropIndex(
            'idx-permintaan_detail-permintaan_id',
            'permintaan_detail'
        );

        // drops foreign key for table `barang`
        $this->dropForeignKey(
            'fk-permintaan_detail-barang_id',
            'permintaan_detail'
        );

        // drops index for column `barang_id`
        $this->dropIndex(
            'idx-permintaan_detail-barang_id',
            'permintaan_detail'
        );

        $this->dropTable('permintaan_detail');
    }
}
