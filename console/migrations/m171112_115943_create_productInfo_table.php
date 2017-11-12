<?php

use yii\db\Migration;

/**
 * Handles the creation of table `productInfo`.
 */
class m171112_115943_create_productInfo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_info', [
            'id'                => $this->primaryKey(),
            'description'       => $this->string()->defaultValue(null),
            'tags'              => $this->string()->defaultValue(null),
            'materials'         => $this->string()->defaultValue(null),
            'seo_keywords'      => $this->string()->defaultValue(null),
            'seo_description'   => $this->string()->defaultValue(null),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_info');
    }
}
