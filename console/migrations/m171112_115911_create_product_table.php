<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m171112_115911_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id'     => $this->primaryKey(),
            'title'  => $this->string(255)->notNull(),
            'slug'   => $this->string(255)->notNull(),
            'price' => $this->integer(11)->defaultValue(0),
            'active' => $this->integer(2)->defaultValue(0),
            'delete' => $this->integer(2)->defaultValue(0),
            'created_at' => $this->integer(11)->defaultValue(0),
            'updated_at' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
