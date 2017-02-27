<?php

require_once __DIR__ . '/models/Db.php';

echo 'Initialize the application? (y - Yes, n - No): ';
$s = fgets(STDIN, 255);

if (trim($s) == "y") {
    echo "Creating the necessary directories...\n";
    mkdir(__DIR__ . '/img/');

    if (!file_exists(__DIR__ . '/config/local.php')) {
        $f = fopen(__DIR__ . '/config/local.php', 'w');
        fwrite($f, '<?php');
        fclose($f);
        echo "Please specify the settings for connecting to the database in the conf/local.php file. See README.md\n";
        exit();
    }
    echo "Create Users table...\n";
    $db = new Db();
    if ($db->errors){
        echo 'DB Error!..';
        exit();
    }

    $db->connection->query("
        CREATE TABLE `users` (
            `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
            `user_token` varchar(255) NOT NULL,
            `login` varchar(255) NOT NULL,
            `pass` varchar(255) NOT NULL,
            `email` varchar(255) DEFAULT NULL,
            `snp` varchar(255) NOT NULL,
            `link_file` varchar(255) DEFAULT NULL,
            `memo` text,
            PRIMARY KEY (`id`),
            UNIQUE KEY `users_login_uindex` (`login`),
            KEY `users_user_token_index` (`user_token`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf-8
    ");

    echo 'Done.' . "\n";
} else {
    echo 'Action canceled by the user.';
}
