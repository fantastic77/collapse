<?php

use yii\db\Migration;

/**
 * Handles adding profile to table `user`.
 */
class m170308_191221_UserModule_add_profile_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'fullname', $this->string());
        $this->addColumn('user', 'address', $this->text());
        $this->addColumn('user', 'phone', $this->integer(24));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'fullname');
        $this->dropColumn('user', 'address');
        $this->dropColumn('user', 'phone');
    }
}
