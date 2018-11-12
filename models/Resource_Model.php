<?php

class Resource_Model
{
    public $resource_id   = 0;
    public $resource_name = '';

    function AddResource($resource_name)
    {
        $this->resource_name = $resource_name;
        $st = DataBase::handler()->prepare("INSERT INTO Resources(resource_name) VALUES (:resource_name)");
        $st->execute(array(
            'resource_name' => $this->resource_name
        ));
        $this->resource_id = DataBase::handler()->lastInsertId();
    }

    function SelectResourceList()
    {
        $st = DataBase::handler()->prepare("SELECT * FROM Resources");
        $st->execute();
        $res = $st->fetchAll();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
    }

    function SelectResourceListForGroup($group_name)
    {
        $st = DataBase::handler()->prepare("SELECT Resources.*, Group_us.group_name FROM Resources INNER JOIN Access ON Resources.resource_id=Access.resource_id INNER JOIN Group_us ON Access.group_id=Group_us.group_id WHERE Group_us.group_name=:group_name");
        $st->execute(array(
            'group_name' => $group_name
        ));
        $res = $st->fetchAll();
        if (!$res) {
            return false;
        } else {
            return $res;
        }
    }

    function SelectResourceById($resource_id)
    {
        $st = DataBase::handler()->prepare("SELECT * FROM Resources WHERE resource_id=:resource_id");
        $st->execute(array(
            'resource_id' => $resource_id
        ));
        $res = $st->fetch();
        if (!$res) {
            return false;
        }
        foreach ($res as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        return $res;
    }

    function SelectResourceByUser($resource_id, $user_id)
    {
        $st = DataBase::handler()->prepare("CALL Select_resource (:resource_id, :user_id)");
        $st->execute(array(
            'resource_id' => $resource_id,
            'user_id'     => $user_id
        ));
        $res = $st->fetch();
        if (!$res) {
            return false;
        }
        foreach ($res as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        return $res;
    }

    function UpdateResource()
    {
        $st = DataBase::handler()->prepare("UPDATE Resources SET resource_name=:resource_name WHERE resource_id=:resource_id");
        $st->execute(array(
            'resource_name' => $this->resource_name,
            'resource_id'   => $this->resource_id
        ));
    }

    function DeleteResource($resource_id)
    {
        $st = DataBase::handler()->prepare("DELETE FROM Resources WHERE resource_id=:resource_id");
        $st->execute(array(
            'resource_id' => $resource_id
        ));
    }
}