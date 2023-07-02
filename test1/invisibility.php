<?php

class Makanan {
    private function printMessage() {
        echo "Hello World";
    }
}

$makanan = new Makanan();

$reflection = new ReflectionMethod('Makanan', 'printMessage');
$reflection->setAccessible(true); // Mengatur aksesibilitas fungsi private menjadi accessible
$reflection->invoke($makanan); // Memanggil fungsi private

// Output: Hello World