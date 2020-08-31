<?php

use yii\db\Migration;

/**
 * Class m200831_144235_AddImageFileOnNews
 */
class m200831_144235_AddImageFileOnNews extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%news}}', 'filename', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%news}}', 'filename');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200831_144235_AddImageFileOnNews cannot be reverted.\n";

        return false;
    }
    */
}
