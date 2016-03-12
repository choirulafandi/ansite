<?php

class Core
{
    public function render($filename, array $data = array())
    {
        foreach ($data as $key => $value) {
            ${$key} = $value;
        }
        include "view/" . $filename . ".php";
    }

    public function getModel($name)
    {
        $class = ucfirst($name);
        include "model/".$class.".php";
        return New $class;
    }
}