<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pembayaran`.
 * Has foreign keys to the tables:
 *
 * - `pemesanan`
 */
class m171130_184728_create_pembayaran_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pembayaran', [
            'id' => $this->primaryKey(),
            'pemesanan_id' => $this->integer()->notNull(),
            'tanggal' => $this->date(),
            'keterangan' => $this->string(100),
            'jumlah_bayar' => $this->integer()->notNull()->defaultValue(0),
            'sisa_tagihan' => $this->integer()->notNull()->defaultValue(0),
        ]);

        // creates index for column `pemesanan_id`
        $this->createIndex(
            'idx-pembayaran-pemesanan_id',
            'pembayaran',
            'pemesanan_id'
        );

        // add foreign key for table `pemesanan`
        $this->addForeignKey(
            'fk-pembayaran-pemesanan_id',
            'pembayaran',
            'pemesanan_id',
            'pemesanan',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `pemesanan`
        $this->dropForeignKey(
            'fk-pembayaran-pemesanan_id',
            'pembayaran'
        );

        // drops index for column `pemesanan_id`
        $this->dropIndex(
            'idx-pembayaran-pemesanan_id',
            'pembayaran'
        );

        $this->dropTable('pembayaran');
    }
}
