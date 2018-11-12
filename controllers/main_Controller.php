<?php

class main_Controller extends Controller
{

    public function indexAction($params = array())
    {

        $this->view->display();
    }

    public function loginAction($params = array())
    {
        $user_mod = new User_Model();
        if ($user_mod->CheckUser($_POST['user_login'], $_POST['user_password'])) {
            Session::set('user', $user_mod->CheckUser($_POST['user_login'], $_POST['user_password']));
            header('Location: /');
        } else {
            echo false;
        }
    }

    public function logoutAction($params = array())
    {
        Session::destroy('user');
        header('Location: /');
    }

    function checkloginAction($params = array())
    {
        if (Session::get('user')) {
            echo Session::get('user');
        } else {
            echo false;
        }
    }

    public function registryuserAction($params = array())
    {
        $else_data = array();
        if ($_POST['user_phone'] != '') {
            $else_data['user_phone'] = $_POST['user_phone'];
        }
        if ($_POST['user_date_birth'] != '') {
            $else_data['user_date_birth'] = $_POST['user_date_birth'];
        }
        $user_mod = new User_Model();
        $user_mod->RegistryUser($_POST['user_login'], $_POST['user_email'], $_POST['user_fio'], $_POST['user_password'],
            $else_data);
        $user_mod->UpdateUserGroup("Junior");
        header('Location: /main');
    }
}