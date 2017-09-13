<?php

use yii\db\Migration;

class m170307_074401_tbl_product extends Migration
{
    public function up()
    {
        $this->execute(
            'CREATE TABLE IF NOT EXISTS `product` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `name` varchar(255) NOT NULL,
                `alias` varchar(255) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;'
        );
    }

    public function down()
    {
        $this->dropTable('product');
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
