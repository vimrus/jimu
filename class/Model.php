<?php
class Model 
{
    public $db;

    public function __construct($data = array())
    {
        $this->db = new DB();  
    }
}
