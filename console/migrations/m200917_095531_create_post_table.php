<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m200917_095531_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(250)->notNull(),
            'short_description' => $this->string(400),
            'description' => $this->text(),
            'is_active' => $this->boolean()->defaultValue(0),
            'created_at' => $this->integer(),
            'created_by' =>$this->integer(),
            'updated_at' =>$this->integer(),
            'updated_by' =>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
