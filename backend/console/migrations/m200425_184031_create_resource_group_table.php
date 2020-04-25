<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resource_group}}`.
 */
class m200425_184031_create_resource_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table_options = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        $this->createTable('{{%resource_group}}', [
            'id' => $this->primaryKey(),
            'ResourceGroupId' => $this->string(),
            'NameRG' => $this->string(),
            'RG_Id' => $this->string(),
            'NameSR' => $this->string(),
            'LongName' => $this->string(),
            'date_created' => $this->integer(),
            'date_modified' => $this->integer(),
        ], $table_options);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resource_group}}');
    }
}
