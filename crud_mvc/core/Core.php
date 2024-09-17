<?php

class Core
{
    public function run()
    {
        // echo "URL: ". $_GET['url']; TESTE

        //meusite.com.br/contatos/cadastrar/1

        $url = '/';
        if (isset($_GET['url'])) {
            //$url = $url . $_GET['url'];

            $url .= $_GET['url'];
        }

        //echo "URL: " . $url; TESTE

        $params = array();

        if (!empty($url) && $url != '/') {
            $url = explode('/', $url); // DIVIDE O ARRAY
            array_shift($url); // REMOVE A "PRIMEIRA" /

            $currentController = $url[0] . 'Controller'; // homeController, contatoController, qualquecoisaquevierController
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }

            if(count($url) > 0){
                $params = $url;            
            }
        }else{
            $currentController = 'homeController';
            $currentAction = 'index';
        }

        // echo 'CONTROLLER: ' . $currentController . '<br>';
        // echo 'ACTION: ' . $currentAction . '<br>';
        // echo 'PARAMS: ' . print_r($params, true) ;

        $c = new $currentController();

        call_user_func_array(array($c, $currentAction), $params);
    }
}