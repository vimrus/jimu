<?php
class IndexHandler extends Handler 
{
    public function index()
    {
        $this->view->name = 'jimu';
        $this->render('index.html.php');
    }
}
