<?php

namespace Fauzannurhidayat\Php\TokoOnline\App {

    function header(string $value)
    {
        echo $value;
    }
}

namespace Fauzannurhidayat\Php\TokoOnline\Service {

    function setcookie(string $name, string $value)
    {
        echo "$name : $value";
    }
}
