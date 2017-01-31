<div class="panel panel-default">
    <div class="panel-heading">
        <h4>All groups</h4>
    </div>
    <?php if($param['user_type']=="Administrator"||$param['user_type']=="Moderator"){?>
    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-add-group">Add group <span class="glyphicon glyphicon-plus"></span></button>
    <?php } ?>
    <table class="table table-hover">
        <tr>
            <th>Group</th>
            <th>Users</th>
            <th></th>
        </tr>
        <?php if(!empty($data)){
            foreach ($data as $key=>$value){
                $href_number=($data[$key]['number_of_users']==0)?"":"/admin/userlistbygroup/".$data[$key]['group_id'];
                ?>
                <tr>
                    <td><?=$data[$key]['group_name']?></td>
                    <td><a href="<?=$href_number?>"><?=$data[$key]['number_of_users']?></a></td>
                    <td class="text-right" style="white-space: nowrap;">
                    <?php if($param['user_type']=="Administrator"){?>
                        <button class="btn btn-xs btn-default btn-edit-group"  data-group_id="<?=$data[$key]['group_id']?>" data-toggle="modal" data-target="#modal-edit-group"><span class="glyphicon glyphicon-pencil"></span></button>
                        <a href="/admin/deletegroup/<?=$data[$key]['group_id']?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                    <?php } ?>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</div>
<div id="modal-add-group" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new group</h4>
            </div>
            <div class="modal-body">
                <form action="/admin/addgroup" method="post" id="form-add-group">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Group name: </span>
                            <input type="text" class="form-control" name="group_name" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" form="form-add-group">Add</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-edit-group" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="media">
                    <div class="media-body">
                        <form action="" method="post" id="form-edit-group">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Group name: </span>
                                    <input type="text" class="form-control" name="group_name" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" form="form-edit-group">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    
    $('.btn-edit-group').on('click',function (e) {
        var btn=e.currentTarget;
        var group_id=$(btn).data("group_id");
        $.ajax({
            url: "/admin/viewgroup/"+group_id,
            type: 'POST',
            success : function (data){
                var data_group=JSON.parse(data);

                $("#form-edit-group input[name='group_name']").val(data_group['group_name']);
                $("#form-edit-group").attr('action','/admin/editgroup/'+data_group['group_id']);
            }
        });
    });


</script>