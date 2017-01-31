<div class="panel panel-default">
    <div class="panel-heading">
        <h4>Access</h4>
    </div>
    <button class="btn btn-primary btn-block btn-add-access" data-toggle="modal" data-target="#modal-add-access">Add access <span class="glyphicon glyphicon-plus"></span></button>
    <table class="table table-hover">
        <tr>
            <th>Date</th>
            <th>Group</th>
            <th>Resource</th>
            <th></th>
        </tr>

        <?php if(!empty($data)){
            foreach ($data as $key=>$value){
                echo"<tr>".
                    "<td>".$data[$key]['access_date']."</td>".
                    "<td><a href="."/admin/userlistbygroup/".$data[$key]['group_id'].">".$data[$key]['group_name']."</a></td>".
                    "<td>".$data[$key]['resource_name']."</td>".
                    "<td class=\"text-right\" style=\"white-space: nowrap;\">".
                        "<a href="."/admin/deleteaccess/".$data[$key]['access_id']." class=\"btn btn-xs btn-danger\"><span class=\"glyphicon glyphicon-remove\"></span></a>".
                    "</td>".
                    "</tr>";
            }
        }
        ?>

    </table>
</div>
<div id="modal-add-access" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add access</h4>
            </div>
            <div class="modal-body">
                <form action="/admin/addaccess" method="post" id="form-add-access">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Resource: </span>
                            <select class="selectpicker form-control" name="resource_id" id=""></select>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">For group: </span>
                            <select class="selectpicker form-control" name="group_id" id=""></select>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" form="form-add-access">Add</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('.btn-add-access').on('click',function (e) {
        $.ajax({
            url: "/admin/selectgrouplist",
            type: 'POST',
            success : function (data){
                var data_group=JSON.parse(data);
                $("#form-add-access select[name='group_id']").html('');
                for(var prop in data_group){
                    $("#form-add-access select[name='group_id']").append("<option value="+data_group[prop]['group_id']+">"+data_group[prop]['group_name']+"</option>");
                }
                $("#form-add-access select[name='group_id']").prop('value',false);
            }
        });
        $.ajax({
            url: "/admin/selectresourcelist",
            type: 'POST',
            success : function (data){
                var data_resource=JSON.parse(data);
                $("#form-add-access select[name='resource_id']").html('');
                for(var prop in data_resource){
                    $("#form-add-access select[name='resource_id']").append("<option value="+data_resource[prop]['resource_id']+">"+data_resource[prop]['resource_name']+"</option>");
                }
                $("#form-add-access select[name='resource_id']").prop('value',false);
            }
        });
    });
</script>