<?php

namespace Fauzannurhidayat\Php\TokoOnline\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{
    public function testRender()
    {
        View::Render('Home/Index',[
            "title" => "PHP Login Management"
        ]);

        $this->expectOutputRegex('[PHP Login Management]');
        $this->expectOutputRegex('[html]');
        $this->expectOutputRegex('[register]');
    }
}