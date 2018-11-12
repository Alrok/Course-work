<?php

class Access_db_Model
{

    function CheckUser($user_db_login, $user_db_password)
    {
        $st = DataBase::handler()->prepare("SELECT Users_db.*,Users_db_types.user_db_type_name FROM Users_db INNER JOIN Users_db_types ON Users_db.user_db_type_id=Users_db_types.user_db_type_id WHERE user_db_login=:user_db_login");
        $st->execute(array(
            'user_db_login' => $user_db_login
        ));
        $res = $st->fetch();
        if (!$res) {
            return false;
        } else {
            if ($res['user_db_password'] == $user_db_password) {
                return $res['user_db_type_name'];
            } else {
                return false;
            }
        }
    }

}