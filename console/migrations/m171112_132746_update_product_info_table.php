<?php

use yii\db\Migration;

/**
 * Class m171112_132746_update_product_info_table
 */
class m171112_132746_update_product_info_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('product_info', 'product_id', $this->integer(11)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m171112_132746_update_product_info_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171112_132746_update_product_info_table cannot be reverted.\n";

        return false;
    }
    */
}
