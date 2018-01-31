<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transactions`.
 */
class m171020_085524_create_transactions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('transactions', [
            'id' => $this->primaryKey(),
            'send_from' => $this->integer(),
            'send_to' => $this->integer(),
            'sum'=>$this->float(),
            'created_at'=>$this->integer(),
        ]);

        // add foreign key for table `users`
        $this->addForeignKey(
            'fk-post-send_from',
            'transactions',
            'send_from',
            'users',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-post-send_to',
            'transactions',
            'send_to',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `post`
        $this->dropForeignKey(
            'fk-post_tag-user_id',
            'transactions'
        );
        $this->dropTable('transactions');
    }
}
