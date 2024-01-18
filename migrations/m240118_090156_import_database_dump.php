<?php

use yii\db\Migration;

/**
 * Class m240118_090156_import_database_dump
 */
class m240118_090156_import_database_dump extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = file_get_contents(__DIR__ . '/test_db_data.sql');
        $this->execute($sql);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240118_090156_import_database_dump cannot be reverted.\n";

        $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        
        $this->truncateTable('{{%orders}}');
        $this->truncateTable('{{%users}}');
        $this->truncateTable('{{%services}}');

        $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
    }
}
