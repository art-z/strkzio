<?php


return [
    'class' => \yii\db\Connection::class,
    'dsn' => 'mysql:host=db;dbname='.$_ENV["MYSQL_DATABASE"],
    'username' => 'root',
    'password' => $_ENV["MYSQL_ROOT_PASSWORD"],
    'charset' => 'utf8',
 

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
