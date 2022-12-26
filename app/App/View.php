<?php

namespace Fauzannurhidayat\PhpMvc\Login\App;

class View
{
    public static function Render(string $view, array $model)
    {
        require __DIR__ . "/../View/header.php";
        require __DIR__ . "/../View/" . $view . ".php";
        require __DIR__ . "/../View/footer.php";
    }
    public static function Redirect(string $url)
    {
        header("Location: $url");
        if(getenv("mode") != "test"){
            exit();
        }
    }
}