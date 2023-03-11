<?php

namespace Fauzannurhidayat\Php\TokoOnline\App;

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
        //     echo "
        // <script>
        //     alert('$status');
        //     window.location.href = '$url';
        // </script>
        // ";
        header("Location: $url");
        if (getenv("mode") != "test") {
            exit();
        }
        
    }
}
