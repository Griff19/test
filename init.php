<?php

require_once __DIR__ . '/models/Db.php';

echo 'Initialize the application? (y - Yes, n - No): ';
$s = fgets(STDIN, 255);

if (trim($s) == "y") {

    echo 'Create Users table...' . "\n";
    $db = new Db();
    $c = $db->connect();

    $c->query("CREATE TABLE `users` (
          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
          `login` varchar(255) NOT NULL,
          `pass` varchar(255) NOT NULL,
          `email` varchar(255) DEFAULT NULL,
          `snp` varchar(255) DEFAULT NULL,
          `link_file` varchar(255) DEFAULT NULL,
          `memo` text,
          PRIMARY KEY (`id`),
          UNIQUE KEY `users_login_uindex` (`login`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
    ");



    echo 'Done.' . "\n";
}
else {
    echo 'Action canceled by the user.';
}
