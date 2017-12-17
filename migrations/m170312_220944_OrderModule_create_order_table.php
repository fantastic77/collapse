<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170312_220944_OrderModule_create_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'order' => $this->text()->notNull(),
            'time' => $this->integer(),
            'status' => $this->integer(),
            'notes' => $this->text(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-order-user_id',
            'order',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-order-user_id',
            'order',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-order-user_id',
            'order'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-order-user_id',
            'order'
        );

        $this->dropTable('order');
    }
}
