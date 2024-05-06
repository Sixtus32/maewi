<?php
namespace Sixtus\Maewi\lib;

class View
{
    public $data;
    public function render(string $name, $data=[]){
        $this->data=$data;
        require 'src/views/' . $name . '.php';
    }
}