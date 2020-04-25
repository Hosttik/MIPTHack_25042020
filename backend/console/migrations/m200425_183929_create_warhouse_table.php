<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%warhouse}}`.
 */
class m200425_183929_create_warhouse_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%warhouse}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(),
            'description' => $this->string(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%warhouse}}');
    }
}
