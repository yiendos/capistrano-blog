<?php

use Phinx\Migration\AbstractMigration;

class AddUserNotes extends AbstractMigration
{
    public function up()
    {

        $sql = <<<EOT
        
ALTER TABLE `j_users` ADD `notes` TEXT DEFAULT NULL AFTER `password`;

UPDATE `j_users` SET `notes` = 'Likes coffee' WHERE `id` = '951'; 

UPDATE `j_users` SET `notes` = 'Likes tea' WHERE `id` = '952'; 

UPDATE `j_users` SET `notes` = 'Likes chai' WHERE `id` = '953';
EOT;

        $this->execute($sql);

    }
    public function down()
    {

        $sql = <<<EOT

ALTER TABLE `j_users` DROP `notes`;

EOT;

        $this->execute($sql);

    }
}
