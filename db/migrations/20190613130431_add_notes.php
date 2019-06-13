<?php

use Phinx\Migration\AbstractMigration;

class AddNotes extends AbstractMigration
{
    public function up()
    {
        $default_disable = <<<EOT
ALTER TABLE `j_users` ADD `notes` TEXT NOT NULL AFTER `password`;
EOT;

        $this->execute($default_disable);
    }

    public function down()
    {
        $default_disable = <<<EOT
ALTER TABLE `j_users` DROP `notes`;
EOT;

        $this->execute($default_disable);
    }
}
