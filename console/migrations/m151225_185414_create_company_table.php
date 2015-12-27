<?php

use yii\db\Schema;
use yii\db\Migration;

class m151225_185414_create_company_table extends Migration
{
    public function up()
    {
		$this->createTable('{{%company}}', [
			'id' => $this->primaryKey(),
			'name' => $this->string()->notNull(),
			'address' => $this->text(),
			'email' => $this->string()->notNull()->unique(),
			'phone' => $this->string(),
			'id_kel' => $this->string(10)
		], "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB");
    }

    public function down()
    {
        echo "m151225_185413_create_company_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
