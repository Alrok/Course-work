<?php

class resources_Controller extends Controller
{

    public function indexAction($params = array())
    {
        $user_id = null;
        $data = 'not-access';
        if (Session::get('user')) {
            $user_id = Session::get('user');
        }
        if ($user_id !== null) {
            $user_mod = new User_Model();
            $user_data = $user_mod->SelectUserById($user_id);
            $group_name = $user_data['group_name'];
            $resource_mod = new Resource_Model();
            $data = $resource_mod->SelectResourceListForGroup($group_name);

        }
        $path = array('resources' => 'views/resources/resources.php');
        $this->view->generateContent($path, $data);
        $this->view->display();

    }

    public function viewresourceAction($params = array())
    {
        if (!Session::get('user')) {
            die;
        }
        $user_id = Session::get('user');
        $resource_id = $params[0];
        $resource_mod = new Resource_Model();
        $data = $resource_mod->SelectResourceByUser($resource_id, $user_id);
        echo json_encode($data);
    }
}