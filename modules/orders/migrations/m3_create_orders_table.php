<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m3_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'link' => $this->string(300)->notNull(),
            'quantity' => $this->integer()->notNull(),
            'service_id' => $this->integer()->notNull(),   
            'status' => $this->tinyInteger(1)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'mode' => $this->tinyInteger(1)->notNull(),
        ]);

        $this->addForeignKey(
            'fk-order-author_id',
            'orders',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-order-user_id',
            'orders',
            'user_id'
        );

        $this->addForeignKey(
            'fk-order-service_id',
            'orders',
            'service_id',
            'services',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-order-user_id',
            'orders'
        );
        
        $this->dropForeignKey(
            'fk-order-user_id',
            'orders'
        );

        $this->dropIndex(
            'idx-order-service_id',
            'orders'
        );
        
        $this->dropForeignKey(
            'fk-order-service_id',
            'orders'
        );

        $this->dropTable('{{%orders}}');
    }
}
