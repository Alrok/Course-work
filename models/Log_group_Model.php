<?php

class Log_group_Model
{
    public $log_id           = 0;
    public $user_id          = 0;
    public $log_date         = '';
    public $group_old_id     = null;
    public $group_present_id = 0;

    public function SelectListLog()
    {
        $st = DataBase::handler()->prepare("SELECT Log_group.*,Users.user_login, group_old.group_name as group_old_name, group_new.group_name as group_new_name FROM Log_group LEFT JOIN Group_us group_old ON Log_group.group_old_id=group_old.group_id INNER JOIN Group_us group_new ON Log_group.group_new_id=group_new.group_id INNER JOIN Users ON Log_group.user_id=Users.user_id");
        $st->execute();
        $res = $st->fetchAll();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
    }

    public static function ClearLog()
    {
        $st = DataBase::handler()->prepare("DELETE FROM Log_group WHERE 1");
        $st->execute();
    }
}