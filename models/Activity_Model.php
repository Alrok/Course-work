<?php
class Activity_Model{
    public $activity_id=0;
    public $activity_date='';
    public $user_id=0;
    public $resource_id=0;

    public function SelectListActivity(){
        $st=DataBase::handler()->prepare("SELECT Activity.*, Users.user_login,Resources.resource_name FROM Activity INNER JOIN Users ON Activity.user_id=Users.user_id INNER JOIN Resources ON Activity.resource_id=Resources.resource_id");
        $st->execute();
        $res=$st->fetchAll();
        if (!$res) return false;
        else return $res;
    }
    public static function ClearActivityLog(){
        $st=DataBase::handler()->prepare("DELETE FROM Activity WHERE 1");
        $st->execute();
    }
}