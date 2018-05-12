<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pemesanan`.
 * Has foreign keys to the tables:
 *
 * - `penawaran`
 */
class m171130_182741_create_pemesanan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pemesanan', [
            'id' => $this->primaryKey(),
            'penawaran_id' => $this->integer()->notNull(),
            'no_surat' => $this->string(50),
            'tanggal' => $this->date(),
            'tanggal_penerimaan' => $this->date(),
            'jumlah_tagihan' => $this->integer(),
        ]);

        // creates index for column `penawaran_id`
        $this->createIndex(
            'idx-pemesanan-penawaran_id',
            'pemesanan',
            'penawaran_id'
        );

        // add foreign key for table `penawaran`
        $this->addForeignKey(
            'fk-pemesanan-penawaran_id',
            'pemesanan',
            'penawaran_id',
            'penawaran',
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
            'fk-pemesanan-penawaran_id',
            'pemesanan'
        );

        // drops index for column `penawaran_id`
        $this->dropIndex(
            'idx-pemesanan-penawaran_id',
            'pemesanan'
        );

        $this->dropTable('pemesanan');
    }
}
