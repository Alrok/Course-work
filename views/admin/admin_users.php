
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a href="#search-user" class="btn btn-default" data-toggle="collapse"><span class="glyphicon glyphicon-search"></span> Search</a>
        </h4>
    </div>
    <div id="search-user" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <form id="search-user-form" action="" class="well well-sm">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Login: </span>
                                <input type="text" class="form-control" name="user_login" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">E-mail: </span>
                                <input type="text" class="form-control" name="user_email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">FIO: </span>
                                <input type="text" class="form-control" name="user_fio" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Phone :</span>
                                <input type="text" class="form-control" name="user_phone" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">Group: </span>
                                <input type="text" class="form-control" name="group_name" value="">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Search</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel panel-default" id="search-user-result" style="display: none">
                <div class="panel-heading">
                    <h4>Result</h4>
                </div>
                <table class="table table-hover user-list">
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h4>
            <?
            if(stristr($_REQUEST['url'],'admin/userlistbygroup')!==false){
                echo $data[0]['group_name']." group";
            }
            else echo "All users";
            ?>
        </h4>

    </div>
    <table class="table table-hover user-list">
        <tr>
            <th>LOGIN</th>
            <th>E-mail</th>
            <th>Group</th>
            <th></th>
        </tr>
        <?php if(!empty($data)){
            foreach ($data as $key=>$value){?>

                <tr>
                    <td><?=$data[$key]['user_login']?></td>
                    <td><?=$data[$key]['user_email']?></td>
                    <td><a href="/admin/userlistbygroup/<?=$data[$key]['group_id']?>"><?=$data[$key]['group_name']?></a></td>
                    <td class="text-right" style="white-space: nowrap;">
                        <button class="btn btn-xs btn-default btn-view-user"  data-user_id="<?=$data[$key]['user_id']?>" data-toggle="modal" data-target="#modal-view-user"><span class="glyphicon glyphicon-eye-open"></span></button>
                        <?php if($param['user_type']=="Administrator"){?>
                            <button class="btn btn-xs btn-default btn-edit-user"  data-user_id="<?=$data[$key]['user_id']?>" data-toggle="modal" data-target="#modal-edit-user"><span class="glyphicon glyphicon-pencil"></span></button>
                            <a href="/admin/deleteuser/<?=$data[$key]['user_id']?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                        <?php } ?>
                    </td>
                </tr>

            <?php
            }
        }
        ?>

    </table>
</div>
<div id="modal-view-user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="media">
                    <div class="media-body">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-eye-close"></span></button>
            </div>
        </div>
    </div>
</div>
<div id="modal-edit-user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="media">
                    <div class="media-body">
                        <form action="" method="post" id="form-edit-user">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Login: </span>
                                    <input type="text" class="form-control" name="user_login" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">E-mail: </span>
                                    <input type="text" class="form-control" name="user_email" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">FIO: </span>
                                    <input type="text" class="form-control" name="user_fio" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Phone :</span>
                                    <input type="text" class="form-control" name="user_phone" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Date birth: </span>
                                    <input type="date" class="form-control" name="user_date_birth" value="">
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Group: </span>
                                <select class="selectpicker form-control" name="group_id" id=""></select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" form="form-edit-user">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#search-user-form').on('submit',function (e) {
        e.preventDefault();
        var data_input=$('#search-user-form').serialize();
        $.ajax({
            url: "/admin/searchuser",
            data: data_input,
            type: 'GET',
            success : function (data){

                var data_result=JSON.parse(data);
                $('#search-user-result').css('display','block');
                $('#search-user-result table tbody').html('');
                $('#search-user-result table tbody').append("<tr><th>LOGIN</th><th>E-mail</th><th>Group</th><th></th></tr>");
                for(var prop in data_result){
                    $('#search-user-result table tbody').append(
                        "<tr>"+
                    "<td>"+data_result[prop]['user_login']+"</td>"+
                    "<td>"+data_result[prop]['user_email']+"</td>"+
                    "<td><a href="+"/admin/userlistbygroup/"+data_result[prop]['group_id']+">"+data_result[prop]['group_name']+"</a></td>"+
                    "<td class=\"text-right\" style=\"white-space: nowrap;\">"+
                    "<button class=\"btn btn-xs btn-default btn-view-user\"  data-user_id="+data_result[prop]['user_id']+" data-toggle=\"modal\" data-target=\"#modal-view-user\"><span class=\"glyphicon glyphicon-eye-open\"></span></button> "+
                    "<button class=\"btn btn-xs btn-default btn-edit-user\"  data-user_id="+data_result[prop]['user_id']+" data-toggle=\"modal\" data-target=\"#modal-edit-user\"><span class=\"glyphicon glyphicon-pencil\"></span></button> "+
                    "<a href="+"/admin/deleteuser/"+data_result[prop]['user_id']+" class=\"btn btn-xs btn-danger\"><span class=\"glyphicon glyphicon-remove\"></span></a>"+
                    "</td>"+
                    "</tr>"
                    );
                }
                
            }
        });
    });
    $('table.user-list').on('click','.btn-view-user',function (e) {
        var btn=e.currentTarget;
        var user_id=$(btn).data("user_id");
        $.ajax({
            url: "/admin/viewuser/"+user_id,
            type: 'POST',
            success : function (data){
                var data_user=JSON.parse(data);
                $('#modal-view-user .modal-body').html('');

                $('#modal-view-user .modal-body').append("<p><strong>Login: </strong>"+data_user["user_login"]+"</p>");
                $('#modal-view-user .modal-body').append("<p><strong>E-mail: </strong>"+data_user["user_email"]+"</p>");
                $('#modal-view-user .modal-body').append("<p><strong>FIO: </strong>"+data_user["user_fio"]+"</p>");
                $('#modal-view-user .modal-body').append("<p><strong>Phone: </strong>"+data_user["user_phone"]+"</p>");
                $('#modal-view-user .modal-body').append("<p><strong>Date birth: </strong>"+data_user["user_date_birth"]+"</p>");
                $('#modal-view-user .modal-body').append("<p><strong>Date reg: </strong>"+data_user["user_date_reg"]+"</p>");
                $('#modal-view-user .modal-body').append("<p><strong>Group: </strong>"+data_user["group_name"]+"</p>");
            }
        });
    });
    $('table.user-list').on('click','.btn-edit-user',function (e) {
        var btn=e.currentTarget;
        var user_id=$(btn).data("user_id");
        $.ajax({
            url: "/admin/viewuser/"+user_id,
            type: 'POST',
            success : function (data){
                var data_user=JSON.parse(data);

                $("#form-edit-user input[name='user_login']").val(data_user['user_login']);
                $("#form-edit-user input[name='user_email']").val(data_user['user_email']);
                $("#form-edit-user input[name='user_fio']").val(data_user['user_fio']);
                $("#form-edit-user input[name='user_phone']").val(data_user['user_phone']);
                $("#form-edit-user input[name='user_date_birth']").val(data_user['user_date_birth']);
                $.ajax({
                    url: "/admin/selectgrouplist",
                    type: 'POST',
                    success : function (data){
                        var data_group=JSON.parse(data);
                        $("#form-edit-user select[name='group_id']").html('');
                        for(prop in data_group){
                            $("#form-edit-user select[name='group_id']").append("<option value="+data_group[prop]['group_id']+">"+data_group[prop]['group_name']+"</option>");
                        }
                        $("#form-edit-user select[name='group_id']").prop('value',data_user['group_id']);
                    }
                });
                $("#form-edit-user").attr('action','/admin/edituser/'+data_user['user_id']);
            }
        });
    });
    $(document).ready(function () {
        function getUrlVars()
        {
            var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
            for(var i = 0; i < hashes.length; i++)
            {
                hash = hashes[i].split('=');
                vars.push(hash[0]);
                vars[hash[0]] = hash[1];
            }
            return vars;
        }
        var params=getUrlVars();
        if(params.indexOf('user_id')!=-1){
            console.log(params['user_id']);
            var user_id=params['user_id'];
            $(".btn-view-user[data-user_id="+user_id+"]").click();
        }
    });
</script>