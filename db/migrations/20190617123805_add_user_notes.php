<?php

use Phinx\Migration\AbstractMigration;

class AddUserNotes extends AbstractMigration
{
    public function up()
    {

        $sql = <<<EOT
        
ALTER TABLE `j_users` ADD `notes` TEXT DEFAULT NULL AFTER `password`;
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
