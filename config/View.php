<?php

class View{

    private $path;
    private $data;

    public function __construct($data)
    {
        // $this->path = $path;
        $this->data = $data;
    }

    public function get_data(){
        return $this->data;
    }



}

?>