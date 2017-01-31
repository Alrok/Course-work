<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Group log</h4>
    </div>
    <a href="/admin/cleargrouplog" class="btn btn-danger btn-block" data-toggle="modal">Clear log <span class="glyphicon glyphicon-remove"></span></a>
    <table class="table table-hover">
        <tr>
            <th>User</th>
            <th>Date</th>
            <th>Group_old</th>
            <th>Group_new</th>
        </tr>
        <?php if(!empty($data)){
            foreach ($data as $key=>$value){
                echo"<tr>".
                    "<td><a href="."/admin/users?user_id=".$data[$key]['user_id'].">".$data[$key]['user_login']."</a></td>".
                        "<td>".$data[$key]['log_date']."</td>".
                        "<td><a href="."/admin/userlistbygroup/".$data[$key]['group_old_id'].">".$data[$key]['group_old_name']."</a></td>".
                    "<td><a href="."/admin/userlistbygroup/".$data[$key]['group_new_id'].">".$data[$key]['group_new_name']."</a></td>".
                    "</tr>";
            }
        }
        ?>
    </table>
</div>