<?php

use yii\db\Migration;

/**
 * Handles the creation of table `productCategory`.
 */
class m171112_122230_create_productCategory_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_category', [
            'id'            => $this->primaryKey(),
            'product_id'    => $this->integer(11)->notNull(),
            'category_id'   => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_category');
    }
}
