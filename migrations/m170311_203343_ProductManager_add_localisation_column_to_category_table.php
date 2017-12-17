<?php

use yii\db\Migration;

/**
 * Handles adding localisation to table `category`.
 */
class m170311_203343_ProductManager_add_localisation_column_to_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category', 'ukr', $this->string());
        $this->addColumn('category', 'rus', $this->string());
        $this->addColumn('category', 'eng', $this->string());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category', 'ukr');
        $this->dropColumn('category', 'rus');
        $this->dropColumn('category', 'eng');
    }
}
