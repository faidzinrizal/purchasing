<?php

use yii\db\Migration;

/**
 * Handles the creation of table `penawaran_detail`.
 * Has foreign keys to the tables:
 *
 * - `penawaran`
 * - `permintaan_detail`
 */
class m171130_182450_create_penawaran_detail_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('penawaran_detail', [
            'id' => $this->primaryKey(),
            'penawaran_id' => $this->integer()->notNull(),
            'permintaan_detail_id' => $this->integer()->notNull(),
            'harga_penawaran' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `penawaran_id`
        $this->createIndex(
            'idx-penawaran_detail-penawaran_id',
            'penawaran_detail',
            'penawaran_id'
        );

        // add foreign key for table `penawaran`
        $this->addForeignKey(
            'fk-penawaran_detail-penawaran_id',
            'penawaran_detail',
            'penawaran_id',
            'penawaran',
            'id',
            'CASCADE'
        );

        // creates index for column `permintaan_detail_id`
        $this->createIndex(
            'idx-penawaran_detail-permintaan_detail_id',
            'penawaran_detail',
            'permintaan_detail_id'
        );

        // add foreign key for table `permintaan_detail`
        $this->addForeignKey(
            'fk-penawaran_detail-permintaan_detail_id',
            'penawaran_detail',
            'permintaan_detail_id',
            'permintaan_detail',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `penawaran`
        $this->dropForeignKey(
            'fk-penawaran_detail-penawaran_id',
            'penawaran_detail'
        );

        // drops index for column `penawaran_id`
        $this->dropIndex(
            'idx-penawaran_detail-penawaran_id',
            'penawaran_detail'
        );

        // drops foreign key for table `permintaan_detail`
        $this->dropForeignKey(
            'fk-penawaran_detail-permintaan_detail_id',
            'penawaran_detail'
        );

        // drops index for column `permintaan_detail_id`
        $this->dropIndex(
            'idx-penawaran_detail-permintaan_detail_id',
            'penawaran_detail'
        );

        $this->dropTable('penawaran_detail');
    }
}
