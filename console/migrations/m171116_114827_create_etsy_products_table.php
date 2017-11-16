<?php

use yii\db\Migration;

/**
 * Handles the creation of table `etsy_products`.
 */
class m171116_114827_create_etsy_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('etsy_products', [
            'id' => $this->primaryKey(),
            'etsy_product_id' => $this->integer(11)->notNull(),
            'etsy_product_object' => $this->string()->notNull(),
            'images' => $this->string()->defaultValue(null),
            'is_exported' => $this->integer(2)->defaultValue(0),
            'result_id' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('etsy_products');
    }
}
