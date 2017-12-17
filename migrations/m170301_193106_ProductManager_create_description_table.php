<?php

use yii\db\Migration;

/**
 * Handles the creation of table `description`.
 * Has foreign keys to the tables:
 *
 * - `products`
 */
class m170301_193106_ProductManager_create_description_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('description', [
            'id' => $this->primaryKey(),
            'productId' => $this->integer()->notNull(),
            'eng_Name' => $this->string(64),
            'ukr_Name' => $this->string(64),
            'rus_Name' => $this->string(64),
            'eng_Description' => $this->text(),
            'ukr_Description' => $this->text(),
            'rus_Description' => $this->text(),
        ]);

        // creates index for column `productId`
        $this->createIndex(
            'idx-description-productId',
            'description',
            'productId'
        );

        // add foreign key for table `products`
        $this->addForeignKey(
            'fk-description-productId',
            'description',
            'productId',
            'products',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `products`
        $this->dropForeignKey(
            'fk-description-productId',
            'description'
        );

        // drops index for column `productId`
        $this->dropIndex(
            'idx-description-productId',
            'description'
        );

        $this->dropTable('description');
    }
}
