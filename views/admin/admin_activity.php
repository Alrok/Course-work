<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Activity log</h4>
    </div>
    <a href="/admin/clearactivitylog" class="btn btn-danger btn-block" data-toggle="modal">Clear log <span class="glyphicon glyphicon-remove"></span></a>
    <table class="table table-hover">
        <tr>
            <th>Date</th>
            <th>User</th>
            <th>Resource</th>
        </tr>
        <?php if(!empty($data)){
            foreach ($data as $key=>$value){
                echo"<tr>".
                    "<td>".$data[$key]['activity_date']."</td>".
                    "<td><a href="."/admin/users?user_id=".$data[$key]['user_id'].">".$data[$key]['user_login']."</a></td>".
                    "<td>".$data[$key]['resource_name']."</td>".
                "</tr>";
            }
        }
        ?>
    </table>
</div>
