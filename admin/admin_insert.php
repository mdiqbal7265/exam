<?php

    require_once 'lib/classes/Database.php';

    $db = new Database();
    
    $email = "admin@gmail.com";
    $password = "123456";
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $db->table('admin')->insert([
        'email' => $email,
        'password' => $password_hash,
    ]);

    echo 'Data inserted Successfully';



?>