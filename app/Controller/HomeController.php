<?php

namespace Fauzannurhidayat\PhpMvc\Login\Controller;

use Fauzannurhidayat\PhpMvc\Login\App\View;

class HomeController
{
    function index()
    {
        View::Render('Home/Index', [
            "title" => "PHP Login Management"
        ]);
    }
}