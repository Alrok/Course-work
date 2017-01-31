<?php
class User_Model{
    public $user_id=0;
    public $user_login='';
    public $user_email='';
    public $user_fio='';
    public $user_phone=null;
    public $user_date_birth=null;
    public $user_date_reg='';
    public $user_password='';
    public $group_id=null;

    function RegistryUser($user_login,$user_email,$user_fio,$user_password,$else_data=array()){
        $data=array('user_login'=>$user_login,
            'user_fio'=>$user_fio,
            'user_email'=>$user_email,
            'user_phone'=>null,
            'user_date_birth'=>null,
            'user_password'=>$user_password);
        if(!empty($else_data)){
            if(isset($else_data["user_phone"])){
                $data["user_phone"]=$else_data["user_phone"];
            }
            if(isset($else_data["user_date_birth"])){
                $data["user_date_birth"]=$else_data["user_date_birth"];
            }
        }
        $regList =array(
            'user_login'=>'/^[a-zA-Z0-9_-]+$/',
            'user_email'=>'/^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i',
            'user_fio'=>'/^[а-яА-ЯёЁa-zA-Z ]+$/',
            'user_phone'=>'/^[+0-9]+$/',
            'user_password'=>'/^[a-zA-Z0-9]{4,20}$/'
        );

        $users_list=$this->SelectUsersList();
        $users_login=array();
        foreach ($users_list as $key=>$value){
            $users_login[]=$users_list[$key]['user_login'];
        }
        if(in_array($user_login,$users_login)) return false;

        foreach ($data as $key=>$value){
            if($value!==null&&isset($regList[$key])){
                if(preg_match($regList[$key], $value)){
                    if (property_exists($this, $key)){
                        $this->$key = $value;
                    }
                }
                else return false;
            }
            else{
                if (property_exists($this, $key)){
                    $this->$key = $value;
                }
            }

        }
        $this->user_date_reg=date('Y-m-d H:m:s');
        $st=DataBase::handler()->prepare("INSERT INTO Users(user_login, user_email, user_fio, user_phone, user_date_birth, user_date_reg) VALUES (:user_login, :user_email, :user_fio, :user_phone, :user_date_birth, :user_date_reg)");
        $st->execute(array(
            'user_login'=>$this->user_login,
            'user_email'=>$this->user_email,
            'user_fio'=>$this->user_fio,
            'user_phone'=>$this->user_phone,
            'user_date_birth'=>$this->user_date_birth,
            'user_date_reg'=>$this->user_date_reg
        ));
        $this->user_id=DataBase::handler()->lastInsertId();
        $st=DataBase::handler()->prepare("INSERT INTO Passwords VALUES (:pass, :pass_date_create, :user_id)");
        $st->execute(array(
            'pass'=>$this->user_password,
            'pass_date_create'=>$this->user_date_reg,
            'user_id'=>$this->user_id
        ));
        return true;
    }
    function SearchUser($params){
        $conditions=array();
        foreach($params as $field=>$value){
            if($value){
                if(property_exists($this,$field)){
                    $conditions[]='Users.'.$field."='".$value."'";
                }
                else if($field==='group_name'){
                    $conditions[]='Group_us.'.$field."='".$value."'";
                }
            }
        }
        $sql="SELECT Users.*, Group_us.group_name FROM Users LEFT JOIN Group_us ON Users.group_id=Group_us.group_id";
        if (sizeof($conditions)) {
            $sql .= ' WHERE ' . implode(' AND ', $conditions);
        }
        $st=DataBase::handler()->prepare($sql);
        $st->execute();
        $res=$st->fetchAll();
        if (!$res) return false;
        else return $res;

    }
    function CheckUser($user_login,$user_password){
        $st=DataBase::handler()->prepare("SELECT user_id, user_login FROM Users WHERE user_login=:user_login");
        $st->execute(array(
            'user_login'=>$user_login
        ));
        $res=$st->fetch();
        if (!$res) return false;
        else {
            $user_id=$res['user_id'];
            $st=DataBase::handler()->prepare("CALL Actual_password (:user_login)");
            $st->execute(array(
                'user_login'=>$user_login
            ));
            $res=$st->fetch();
            if($res['pass']==$user_password) return $user_id;
            else return false;
        }
    }
    function SelectUsersList(){
        $st=DataBase::handler()->prepare("SELECT Users.*, Group_us.group_name FROM Users LEFT JOIN Group_us ON Users.group_id=Group_us.group_id");
        $st->execute();
        $res=$st->fetchAll();
        if (!$res) return false;
            else return $res;
    }
    function SelectUsersListByGroupId($group_id){
        $st=DataBase::handler()->prepare("SELECT Users.*, Group_us.group_name FROM Users INNER JOIN Group_us ON Users.group_id=Group_us.group_id WHERE Users.group_id=:group_id");
        $st->execute(array(
            'group_id'=>$group_id
        ));
        $res=$st->fetchAll();
        if (!$res) return false;
        else return $res;
    }
    function SelectUserById($user_id){
        $st=DataBase::handler()->prepare("SELECT Users.*, Group_us.group_name FROM Users LEFT JOIN Group_us ON Users.group_id=Group_us.group_id WHERE user_id=:user_id");
        $st->execute(array(
                    'user_id'=>$user_id
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
    function DeleteUser($user_id){
        $st=DataBase::handler()->prepare("DELETE FROM Users WHERE user_id=:user_id");
        $st->execute(array(
            'user_id'=>$user_id
        ));
    }
    function UpdateUserGroup($group_name){
        $st=DataBase::handler()->prepare("UPDATE Users SET group_id=(SELECT group_id FROM Group_us WHERE group_name=:group_name) WHERE user_id=:user_id");
        $st->execute(array(
            'group_name'=>$group_name,
            'user_id'=>$this->user_id
        ));
    }
    function UpdateUser(){
        $st=DataBase::handler()->prepare("UPDATE Users SET user_login=:user_login,user_email=:user_email,user_fio=:user_fio,user_phone=:user_phone,user_date_birth=:user_date_birth,group_id=:group_id WHERE user_id=:user_id");
        $st->execute(array(
           'user_login'=>$this->user_login,
            'user_email'=>$this->user_email,
            'user_fio'=>$this->user_fio,
            'user_phone'=>$this->user_phone,
            'user_date_birth'=>$this->user_date_birth,
            'group_id'=>$this->group_id,
            'user_id'=>$this->user_id
        ));
    }
}