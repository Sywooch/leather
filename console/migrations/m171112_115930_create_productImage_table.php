<?php

use yii\db\Migration;

/**
 * Handles the creation of table `productImage`.
 */
class m171112_115930_create_productImage_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_image', [
            'id'            => $this->primaryKey(),
            'name'          => $this->string(255)->notNull(),
            'main'          => $this->integer(2)->defaultValue(0),
            'product_id'    => $this->integer(11)->notNull(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_image');
    }
}
