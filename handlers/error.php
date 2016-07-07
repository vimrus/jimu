<?php
class ErrorHandler extends Handler 
{
    public function notFound()
    {
        $this->display(404, "not found");
    }
}
