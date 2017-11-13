<?php

use yii\db\Migration;

/**
 * Class m171112_190352_update_product_table
 */
class m171112_190352_update_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('product', 'has_images', $this->integer(2)->defaultValue(0));
        $this->addColumn('product', 'has_categories', $this->integer(2)->defaultValue(0));
    }

    public function safeDown()
    {
        echo "m171112_190352_update_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171112_190352_update_product_table cannot be reverted.\n";

        return false;
    }
    */
}
