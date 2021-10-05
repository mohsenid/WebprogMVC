<?php
/*
*App core Class
*Create URL & Load Core Controller
* URL Format - Controller/method/param
*/
class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        // Look in Controllers folder for first value 
        if(!empty($url) && file_exists('../App/Controllers/' . ucwords($url[0]) . '.php')){
            //if existe set as controller
            
        // var_dump($url);
            $this->currentController = ucwords($url[0]);

            //unset 0 index
            unset($url[0]);
        }
        //Require the controller
        require_once '../App/Controllers/' . $this->currentController . '.php';

        //Init the controller
        $this->currentController = new $this->currentController;

        //Check for second part of url
        if(isset($url[1])){
            //Check to see if method existe in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];

                //Unset index 1
                unset($url[1]);
            }
        }
        // Get Params
        $this->params = $url ?array_values($url) : [];

        // Call a callback with arry of params
        call_user_func_array([$this->currentController, $this->currentMethod],$this->params);
    }
    public function getUrl(){
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        } else {
            return [];
        }
    }
}
