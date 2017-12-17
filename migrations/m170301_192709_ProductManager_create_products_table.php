<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 * Has foreign keys to the tables:
 *
 * - `category`
 */
class m170301_192709_ProductManager_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull()->unique(),
            'categoryId' => $this->integer()->notNull(),
            'price' => $this->integer(),
        ]);

        // creates index for column `categoryId`
        $this->createIndex(
            'idx-products-categoryId',
            'products',
            'categoryId'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-products-categoryId',
            'products',
            'categoryId',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-products-categoryId',
            'products'
        );

        // drops index for column `categoryId`
        $this->dropIndex(
            'idx-products-categoryId',
            'products'
        );

        $this->dropTable('products');
    }
}
