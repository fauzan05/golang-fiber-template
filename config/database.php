<?php

function getDatabaseConfig():array
{
    return [
        "database" => [
            "test" => [
                "url" => "mysql:host=localhost:3306;dbname=toko_online_test",
                "username" => "root",
                "password" => ""
            ],
            "prod" => [
                "url" => "mysql:host=localhost:3306;dbname=toko_online",
                "username" => "root",
                "password" => ""
            ]
        ]
    ];
}