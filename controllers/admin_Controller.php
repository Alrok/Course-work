<?php
class admin_Controller extends Controller{

    function __construct()
    {
        session_start();
        parent::__construct();
        $this->view->setTemplate("views/admin/admin_main_template.php",array('user_type'=>Session::get('admin')));
    }

    public function indexAction($params=array()){
        header('Location: /admin/login/');
        die;
    }
    public function loginAction($params=array()){
        if (self::checkLogin()) {
            header('Location: /admin/users/');
            die;
        }
        else if(isset($_POST['user_db_login'])&&isset($_POST['user_db_password'])){
            $user_mod = new Access_db_Model();
            if($user_mod->CheckUser($_POST['user_db_login'],$_POST['user_db_password'])){
                Session::set('admin',$user_mod->CheckUser($_POST['user_db_login'],$_POST['user_db_password']));
                header('Location: /admin/users/');
                die;
            }
        }
        $path=array('login'=>'views/admin/login.php');
        $this->view->generateContent($path);
        $this->view->display();
    }
    public static function logoutAction($params=array()) {

        Session::destroy('admin');
        header('Location: /admin/login/');
        die;
    }

    protected function checkLogin() {
        if(Session::get('admin')){
            return true;
        }
        else return false;
    }
   
    //Users
    public function usersAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $user_mod=new User_Model();
        $data=$user_mod->SelectUsersList();
        $path=array('users'=>'views/admin/admin_users.php');
        $this->view->generateContent($path,$data);
        $this->view->display();
    }
    public function userlistbygroupAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $group_id=$params[0];
        $user_mod=new User_Model();
        $data=$user_mod->SelectUsersListByGroupId($group_id);
        $path=array('users'=>'views/admin/admin_users.php');
        $this->view->generateContent($path,$data);
        $this->view->display();
    }
    public function viewuserAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $user_id=$params[0];
        $user_mod = new User_Model();
        $data=$user_mod->SelectUserById($user_id);
        echo json_encode($data);
    }
    public function deleteuserAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $user_id=$params[0];
        $user_mod = new User_Model();
        $user_mod->DeleteUser($user_id);
        header('Location: /admin/users/');
    }
    public function edituserAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $user_id=$params[0];
        $user_mod = new User_Model();
        $user_mod->SelectUserById($user_id);
        foreach ($_POST as $key=>$value){
            if(property_exists('User_Model',$key)){
                $user_mod->$key=$value;
            }
        }
        $user_mod->UpdateUser();
        header('Location: /admin/users/');
    }
    public function searchuserAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $user_mod=new User_Model();
        $data=$user_mod->SearchUser($_GET);
        echo json_encode($data);
    }
    
    
    //Group
    public function groupAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $group_mod=new Group_Model();
        $data=$group_mod->SelectGroupListAndUsers();
        $path=array('group'=>'views/admin/admin_group.php');
        $this->view->generateContent($path,$data);
        $this->view->display();
    }
    public function selectgrouplistAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $group_mod=new Group_Model();
        $data=$group_mod->SelectGroupList();
        echo json_encode($data);
    }
    public function viewgroupAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $group_id=$params[0];
        $group_mod=new Group_Model();
        $data=$group_mod->SelectGroupById($group_id);
        echo json_encode($data);
    }
    public function addgroup($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $group_mod=new Group_Model();
        $group_mod->AddGroup($_POST['group_name']);
        header('Location : /admin/group');
    }
    public function editgroupAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $group_id=$params[0];
        $group_mod=new Group_Model();
        $group_mod->SelectGroupById($group_id);
        $group_mod->group_name=$_POST['group_name'];
        $group_mod->UpdateGroup();
        header('Location: /admin/group/');
    }
    public function deletegroupAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $group_id=$params[0];
        $group_mod = new Group_Model();
        $group_mod->DeleteGroup($group_id);
        header('Location: /admin/group/');
    }

    //Resources
    public function resourceAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $resource_mod=new Resource_Model();
        $data=$resource_mod->SelectResourceList();
        $path=array('resource'=>'views/admin/admin_resource.php');
        $this->view->generateContent($path,$data);
        $this->view->display();
    }
    public function selectresourcelistAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $resource_mod=new Resource_Model();
        $data=$resource_mod->SelectResourceList();
        echo json_encode($data);
    }
    public function viewresourceAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $resource_id=$params[0];
        $resource_mod=new Resource_Model();
        $data=$resource_mod->SelectResourceById($resource_id);
        echo json_encode($data);
    }
    public function addresourceAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $resource_mod=new Resource_Model();
        $resource_mod->AddResource($_POST['resource_name']);
        header('Location: /admin/resource/');
    }
    public function editresourceAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $resource_id=$params[0];
        $resource_mod=new Resource_Model();
        $resource_mod->SelectResourceById($resource_id);
        $resource_mod->resource_name=$_POST['resource_name'];
        $resource_mod->UpdateResource();
        header('Location: /admin/resource/');
    }
    public function deleteresourceAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $resource_id=$params[0];
        $resource_mod = new Resource_Model();
        $resource_mod->DeleteResource($resource_id);
        header('Location: /admin/resource/');
    }

    //Access
    public function accessAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $access_mod=new Access_Model();
        $data=$access_mod->SelectListAccess();
        $path=array('access'=>'views/admin/admin_access.php');
        $this->view->generateContent($path,$data);
        $this->view->display();
    }
    public function addaccessAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $access_mod=new Access_Model();
        $access_mod->AddAccess($_POST['group_id'],$_POST['resource_id']);
        header('Location: /admin/access/');
    }
    public function deleteaccessAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $access_id=$params[0];
        $access_mod = new Access_Model();
        $access_mod->DeleteAccess($access_id);
        header('Location: /admin/access/');
    }
    
    //Activity log
    public function activityAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $activity_mod=new Activity_Model();
        $data=$activity_mod->SelectListActivity();
        $path=array('activity'=>'views/admin/admin_activity.php');
        $this->view->generateContent($path,$data);
        $this->view->display(); 
    }
    public function clearactivitylogAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        Activity_Model::ClearActivityLog();
        header('Location: /admin/activity/');

    }

    //Log_group
    public function log_groupAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $log_mod=new Log_group_Model();
        $data=$log_mod->SelectListLog();
        $path=array('log_group'=>'views/admin/admin_log_group.php');
        $this->view->generateContent($path,$data);
        $this->view->display();
    }
    public function cleargrouplogAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        Log_group_Model::ClearLog();
        header('Location: /admin/log_group/');

    }
    
    //Reports
    public function reportsAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $data=null;
        $path=array('reports'=>'views/admin/admin_reports.php');
        $this->view->generateContent($path,$data);
        $this->view->display();
    }
    public function amountuserperiodAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $report_mod=new Report_Model();
        $data=$report_mod->UsersRegisteredForThePeriod($_GET['period_from'],$_GET['period_to']);
        echo json_encode($data);
    }
    public function amountviewsAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $report_mod=new Report_Model();
        $data=$report_mod->UserActivityForThePeriod($_GET['user_login'],$_GET['period_from'],$_GET['period_to']);
        echo json_encode($data);
    }
    public function groupAccessAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $report_mod=new Report_Model();
        $data=$report_mod->GroupAccessForThePeriod($_GET['group_name'],$_GET['period_from'],$_GET['period_to']);
        echo json_encode($data);
    }
    public function addingroupAction($params=array()){
        if (!self::checkLogin()) {
            header('Location: /admin/login/');
            die;
        }
        $report_mod=new Report_Model();
        $data=$report_mod->AddInGroupForThePeriod($_GET['group_name'],$_GET['period_from'],$_GET['period_to']);
        echo json_encode($data);
    }
}
