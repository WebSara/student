<?php
class Request {

    public $controller = 'index';
    public $action = 'index';
    private $params = array();
    private $post = array();
    private $files = array();
    private $get = array();
    private $cookies = array();
    private $method = 'GET';
    public $orgin_action = 'index';


    public function __construct()
    {
       
        $this->method = $_SERVER['REQUEST_METHOD'];
        

        $uri = ltrim($_SERVER['REQUEST_URI'], "/");

        if (!empty($uri) && strpos($uri, "public") !== 0)
        {
            // strip parameters
            $uri = current(explode("?", $uri));
            // separate ctrl and action
            $params = explode("/", $uri);

            // if controller only
            if (count($params) >= 1 && !empty($params[0]))
            {
                $this->controller = $params[0];
            }
            // + action
            if (count($params) >= 2)
            {
                //preserve action name
                $this->orgin_action = $params[1];
                $action = '';
                // form single name
                $items = explode("-", $params[1]);
                if (count($items) > 1)
                {
                    foreach ($items as $item)
                    {
                        $action .= ucfirst($item);
                    }

                    $action = lcfirst($action);
                }
                else
                {
                    $action = $params[1];
                }
                $this->action = $action;
            }
            // third url value
            if (count($params) == 3)
            {
                // assign value as from GET
                $this->params[] = 'id';
                $this->get['id'] = $params[2];
            }


        }
    }   

}
