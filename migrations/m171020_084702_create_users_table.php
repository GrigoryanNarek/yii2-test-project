<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m171020_084702_create_users_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'nik' => $this->string(12)->unique(),
            'balance' => $this->float()->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('users');
    }
}
