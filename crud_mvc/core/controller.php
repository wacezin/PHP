<?php

class controller{
    // RESPONSÁVEL EM MONSTRAR O QUE ESTIVER NA PASTA VIEW
    public function loadView($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }

    // TRAZER OS ARQUIVOS DA VIEW
    public function loadTemplate($viewName, $viewData = array()){
        require 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()){
        extract($viewData);
        require 'views/'.$viewName.'.php';
    }
}