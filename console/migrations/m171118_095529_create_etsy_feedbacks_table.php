<?php

use yii\db\Migration;

/**
 * Handles the creation of table `etsy_feedbacks`.
 */
class m171118_095529_create_etsy_feedbacks_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('etsy_feedbacks', [
            'id' => $this->primaryKey(),
            'feedback_id' => $this->integer(11)->notNull(),
            'feedback_serialize' => $this->text()->notNull(),
            'export_status' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('etsy_feedbacks');
    }
}
