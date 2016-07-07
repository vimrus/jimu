<?php
/**
 * Base controller of Application.
 */
class Handler
{
    public $view;
    public $controller;
    public $action;
    public $method;

    public $statusCode = array(
        100 => "100 Continue",
        101 => "101 Switching Protocols",
        102 => "102 Processing",
                    
        200 => "200 OK",
        201 => "201 Created",
        202 => "202 Accepted",
        203 => "203 Non-Authoritative Information",
        204 => "204 No Content",
        205 => "205 Reset Content",
        206 => "206 Partial Content",
        207 => "207 Multi-Status",
                    
        300 => "300 Multiple Choices",
        301 => "301 Moved Permanently",
        302 => "302 Found",
        303 => "303 See Other",
        304 => "304 Not Modified",
        305 => "305 Use Proxy",
        307 => "307 Temporary Redirect",
                    
        400 => "400 Bad Request",
        401 => "401 Authorization Required",
        402 => "402 Payment Required",
        403 => "403 Forbidden",
        404 => "404 Not Found",
        405 => "405 Method Not Allowed",
        406 => "406 Not Acceptable",
        407 => "407 Proxy Authentication Required",
        408 => "408 Request Time-out",
        409 => "409 Conflict",
        410 => "410 Gone",
        411 => "411 Length Required",
        412 => "412 Precondition Failed",
        413 => "413 Request Entity Too Large",
        414 => "414 Request-URI Too Large",
        415 => "415 Unsupported Media Type",
        416 => "416 Requested Range Not Satisfiable",
        417 => "417 Expectation Failed",
        422 => "422 Unprocessable Entity",
        423 => "423 Locked",
        424 => "424 Failed Dependency",
        426 => "426 Upgrade Required",
                    
        500 => "500 Internal Server Error",
        501 => "501 Method Not Implemented",
        502 => "502 Bad Gateway",
        503 => "503 Service Temporarily Unavailable",
        504 => "504 Gateway Time-out",
        505 => "505 HTTP Version Not Supported",
        506 => "506 Variant Also Negotiates",
        507 => "507 Insufficient Storage",
        510 => "510 Not Extended"
    );

    public function __construct()
    {
        $this->view = new stdclass();
    }

    public function redirect($path, $code = 302) 
    {
        @header("Location: {$path}", true, $code);
        exit;
    }

    public function display($code, $data)
    {
        header("Content-type: application/json");
        header("HTTP/1.1 {$this->statusCode[$code]}");
        echo $data; 
        exit;
    }

    public function render($view)
    { 
        $vars = get_object_vars($this->view);
        extract($vars, EXTR_SKIP);

        ob_start();
        include(SP . 'views/' . $view);
        die(trim(ob_get_clean()));
    }

    public function json($code, $data)
    {
        header("Content-type: application/json");
        header("HTTP/1.1 {$this->statusCode[$code]}");
        echo json_encode($data); 
        exit;
    }

	public function loadModel($moduleName)
	{
		include(SP . 'models/' . strtolower($moduleName) . '.php');
        $modelName = ucfirst($moduleName) . 'Model';
		return new $modelName();
	}
}
