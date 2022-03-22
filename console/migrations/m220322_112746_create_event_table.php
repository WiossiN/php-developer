<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event}}`.
 */
class m220322_112746_create_event_table extends Migration
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

        $this->createTable('{{%event}}', [
            'id' => $this->primaryKey(),
            'goal' => $this->string()->notNull(),
            'cost' => $this->integer()->notNull(),
            'endpoint' => $this->integer()->notNull(),
            'status' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        // creates index for column `endpoint`
        $this->createIndex(
            '{{%idx-event-endpoint}}',
            '{{%event}}',
            'endpoint'
        );

        // add foreign key for table `{{%endpoint}}`
        $this->addForeignKey(
            '{{%fk-event-endpoint}}',
            '{{%event}}',
            'endpoint',
            '{{%endpoint}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%endpoint}}`
        $this->dropForeignKey(
            '{{%fk-event-endpoint}}',
            '{{%event}}'
        );

        // drops index for column `endpoint`
        $this->dropIndex(
            '{{%idx-event-endpoint}}',
            '{{%event}}'
        );

        $this->dropTable('{{%event}}');
    }
}
