<?php

class Group_Model{
    public $group_id=0;
    public $group_name='';
    
    function AddGroup($group_name){
        $this->group_name=$group_name;
        $st=DataBase::handler()->prepare("INSERT INTO Group_us(group_name) VALUES (:group_name)");
        $st->execute(array(
            'group_name'=>$this->group_name
        ));
        $this->group_id=DataBase::handler()->lastInsertId();
        
    }
    function SelectGroupList(){
        $st=DataBase::handler()->prepare("SELECT * FROM Group_us");
        $st->execute();
        $res=$st->fetchAll();
        if (!$res) return false;
        else return $res;
    }
    function SelectGroupListAndUsers(){
        $st=DataBase::handler()->prepare("SELECT Group_us.*, COUNT(Users.group_id) AS number_of_users FROM Group_us LEFT JOIN Users ON Group_us.group_id=Users.group_id GROUP BY Group_us.group_id ");
        $st->execute();
        $res=$st->fetchAll();
        if (!$res) return false;
        else return $res;
    }
    function SelectGroupById($group_id){
        $st=DataBase::handler()->prepare("SELECT * FROM Group_us WHERE group_id=:group_id");
        $st->execute(array(
            'group_id'=>$group_id
        ));
        $res = $st->fetch();
        if (!$res) return false;
        foreach($res as $key => $value){
            if (property_exists($this, $key)){
                $this->$key = $value;
            }
        }
        return $res;
    }
    function UpdateGroup(){
        $st=DataBase::handler()->prepare("UPDATE Group_us SET group_name=:group_name WHERE group_id=:group_id");
        $st->execute(array(
            'group_name'=>$this->group_name,
            'group_id'=>$this->group_id
        ));
    }
    function DeleteGroup($group_id){
        $st=DataBase::handler()->prepare("DELETE FROM Group_us WHERE group_id=:group_id");
        $st->execute(array(
            'group_id'=>$group_id
        ));
    }
}