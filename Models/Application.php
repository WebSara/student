<?php
include('request.php');
class Application {

    public $request = null;
    public $config = null;
    private $template = 'layout';
    private $dbConfig = array(
        'host'      =>  'localhost',
        'dbName'    =>  'student',
        'user'      =>  'root',
        'password'  =>  ''
    );
    
    /**
     * Run application
     */
    public function start()
    {
        $this->request = new Request();

                // Connect to the database using mysqli
        $conn = new mysqli($this->dbConfig['host'], $this->dbConfig['user'], $this->dbConfig['password'], $this->dbConfig['dbName']);
    
        // get controller name
        $cname = ucfirst($this->request->controller) . 'Controller';

        require_once( realpath(__DIR__ . '/..') . '/controllers/'. $cname . '.php');

        $controller = new $cname();

        $controller->view = new View();

        $controller->layout['content'] = $controller->{$this->request->action}();
        
        echo $controller->view->render($this->template, $controller->layout);
    }

}
