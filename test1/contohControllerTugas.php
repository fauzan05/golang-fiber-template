<?php

require_once __DIR__ . "/Role.php";
require_once __DIR__ . "/View.php";

class UserController
{
    public function insert()
    {
        $insertRole = new Role();
        $insertRole->setIdRole($_POST['idRole']);
        $insertRole->setNameRole($_POST['nameRole']);
        $insertRole->setKeterangan($_POST['keteranganRole']);
        $insertRole->saveAll();
        header("Location: /");
    }
}