<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m171130_171032_user
 */
class m171130_171032_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(
            'user',
            [
                'id' => Schema::TYPE_PK,
                'username' => Schema::TYPE_STRING,
                'group_user' => Schema::TYPE_STRING,
                'password' => Schema::TYPE_STRING
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171130_171032_user cannot be reverted.\n";

        return false;
    }
    */
}
