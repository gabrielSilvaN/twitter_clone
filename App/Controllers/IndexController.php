<?php

namespace App\Controllers;

use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action
{


    public function index()
    {
        $this->view->login = isset($_GET['login']) ? $_GET['login'] : ''; 
        $this->render('index'); //se não passarmos o layout, ele por padrão irá usar 'layout'
    }

    public function inscreverse()
    {

        $this->view->usuario = array(
            'nome' => '',
            'email' => '',
            'senha' => ''
        );

        $this->view->erroCadastro = false;        
        
        $this->render('inscreverse');
    }

    //exemplo clássico de rota que não renderiza uma view, mas que somente têm um controller para realizar determinada ação
    // poderiamos ter rotas que se encaixam nesta situação: valida login, upload de arquivos, etc...
    public function registrar()
    {
        
        $usuario = Container::getModel('Usuario');
        $usuario->__set('nome', $_POST['nome']);
        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', md5($_POST['senha']));

        if ($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0) {

            $usuario->salvar();
            $this->render('cadastro');

        } else {

            $this->view->usuario = array(
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'senha' => $_POST['senha']
            );

            $this->view->erroCadastro = true;
            $this->render('inscreverse');

        }
    }
}
