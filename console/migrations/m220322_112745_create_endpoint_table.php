<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%endpoint}}`.
 */
class m220322_112745_create_endpoint_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%endpoint}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'endpoint' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'parameters' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%endpoint}}');
    }
}
