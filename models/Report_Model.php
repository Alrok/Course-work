<?php
class Report_Model{
   function UsersRegisteredForThePeriod($period_from,$period_to){
       $st=DataBase::handler()->prepare("CALL Users_registered_for_the_period (:period_from, :period_to)");
       $st->execute(array(
           'period_from'=>$period_from,
           'period_to'=>$period_to
       ));
       $res=$st->fetch();
       if (!$res) return false;
       else return $res;
   }
    function UserActivityForThePeriod($user_login,$period_from,$period_to){
        $st=DataBase::handler()->prepare("CALL User_activity_for_the_period (:user_login,:period_from, :period_to)");
        $st->execute(array(
            'user_login'=>$user_login,
            'period_from'=>$period_from,
            'period_to'=>$period_to
        ));
        $res=$st->fetchAll();
        if (!$res) return false;
        else return $res;
    }
    function GroupAccessForThePeriod($group_name,$period_from,$period_to){
        $st=DataBase::handler()->prepare("CALL Group_access_for_the_period (:group_name,:period_from, :period_to)");
        $st->execute(array(
            'group_name'=>$group_name,
            'period_from'=>$period_from,
            'period_to'=>$period_to
        ));
        $res=$st->fetchAll();
        if (!$res) return false;
        else return $res;
    }
    function AddInGroupForThePeriod($group_name,$period_from,$period_to){
        $st=DataBase::handler()->prepare("CALL Add_in_group_for_the_period (:group_name,:period_from, :period_to)");
        $st->execute(array(
            'group_name'=>$group_name,
            'period_from'=>$period_from,
            'period_to'=>$period_to
        ));
        $res=$st->fetch();
        if (!$res) return false;
        else return $res;
    }
}