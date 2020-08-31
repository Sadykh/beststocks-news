<?php

use yii\db\Migration;

/**
 * Class m200831_114954_CreateComments
 */
class m200831_114954_CreateComments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer()->notNull(),
            'name' => $this->text()->notNull(),
            'email' => $this->text()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        $this->addForeignKey('comment_news', 'comment', 'news_id', 'news', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200831_114954_CreateComments cannot be reverted.\n";

        return false;
    }
    */
}
