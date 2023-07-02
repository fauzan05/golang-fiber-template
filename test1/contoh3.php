<?php

class makanan {
    private string $id;
    private string $name = "Haha";

    public function setName($name){
        $this->name = $name;
    }

    public function getName():String{
        return $this->name;
    }

    private static function print(){
        echo "Hello World";
    }

    public function print1(){
        makanan::print();
    }

}

$makanan = new makanan();
// $makanan->print1();

$makanan->getName();
