<?php

use Phinx\Migration\AbstractMigration;

class AddNotes extends AbstractMigration
{
    public function up()
    {
        $sql = <<<EOT
ALTER TABLE `j_users` ADD `notes` TEXT NOT NULL AFTER `password`;

INSERT INTO `j_users` (`id`, `name`, `username`, `email`, `password`, `notes`, `block`, `sendEmail`, `registerDate`, `lastvisitDate`, `activation`, `params`, `lastResetTime`, `resetCount`, `otpKey`, `otep`, `requireReset`)
VALUES
	(954, 'Nobody', 'nobody', 'nobody@example.com', 'e0f025cc620a663e172c8b25911e5c4e:44wqdHQWhDPcrRg5koGsWJ9Zlhr9WC5x', '', 0, 0, '2013-07-24 10:53:59', '0000-00-00 00:00:00', '', '{\"admin_style\":\"\",\"admin_language\":\"\",\"language\":\"\",\"editor\":\"\",\"helpsite\":\"\",\"timezone\":\"\"}', '0000-00-00 00:00:00', 0, '', '', 0);

EOT;

        $this->execute($sql);
    }

    public function down()
    {
        $sql = <<<EOT
ALTER TABLE `j_users` DROP `notes`;

DELETE FROM `j_users` WHERE `id` = '954';

EOT;

        $this->execute($sql);
    }
}
