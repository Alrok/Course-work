<?php

class Access_Model
{
    public $access_id    = 0;
    public $access_date  = '';
    public $resources_id = 0;
    public $group_id     = 0;

    public function SelectListAccess()
    {
        $st = DataBase::handler()->prepare("SELECT Access.*,Resources.resource_name,Group_us.group_name FROM Access INNER JOIN Resources ON Resources.resource_id=Access.resource_id INNER JOIN Group_us ON Group_us.group_id=Access.group_id ");
        $st->execute();
        $res = $st->fetchAll();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
    }

    public function SelectAccessById($access_id)
    {
        $st = DataBase::handler()->prepare("SELECT Access.*,Resources.resource_name,Group_us.group_name FROM Access INNER JOIN Resources ON Resources.resource_id=Access.resource_id INNER JOIN Group_us ON Group_us.group_id=Access.group_id WHERE access_id=:access_id");
        $st->execute(array(
            'access_id' => $access_id
        ));
        $res = $st->fetch();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
    }

    public function AddAccess($group_id, $resource_id)
    {
        $this->group_id = $group_id;
        $this->resources_id = $resource_id;
        $this->access_date = date('Y-m-d H:m:s');
        $st = DataBase::handler()->prepare("INSERT INTO Access(access_date,resource_id,group_id) VALUES (:access_date,:resource_id,:group_id)");
        $st->execute(array(
            'access_date' => $this->access_date,
            'resource_id' => $this->resources_id,
            'group_id'    => $this->group_id
        ));
        $this->access_id = DataBase::handler()->lastInsertId();
    }

    public function DeleteAccess($access_id)
    {
        $st = DataBase::handler()->prepare("DELETE FROM Access WHERE access_id=:access_id");
        $st->execute(array(
            'access_id' => $access_id
        ));
    }
}