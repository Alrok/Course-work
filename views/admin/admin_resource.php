<div class="panel panel-default">
    <div class="panel-heading">
        <h4>All resources</h4>
    </div>
    <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-add-resource">Add resource <span class="glyphicon glyphicon-plus"></span></button>
    <table class="table table-hover">
        <tr>
            <th>Resource name</th>
            <th></th>
        </tr>
        <?php if(!empty($data)){
            foreach ($data as $key=>$value){
                echo"<tr>".
                        "<td>".$data[$key]['resource_name']."</td>".
                        "<td class=\"text-right\" style=\"white-space: nowrap;\">".
                            "<button class=\"btn btn-xs btn-default btn-edit-resource\"  data-resource_id=".$data[$key]['resource_id']." data-toggle=\"modal\" data-target=\"#modal-edit-resource\"><span class=\"glyphicon glyphicon-pencil\"></span></button> ".
                            "<a href="."/admin/deleteresource/".$data[$key]['resource_id']." class=\"btn btn-xs btn-danger\"><span class=\"glyphicon glyphicon-remove\"></span></a>".
                        "</td>".
                    "</tr>";
            }
        }
        ?>

    </table>
</div>
<div id="modal-add-resource" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add new resource</h4>
            </div>
            <div class="modal-body">
                <form action="/admin/addresource" method="post" id="form-add-resource">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">Resource name: </span>
                            <input type="text" class="form-control" name="resource_name" value="">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" form="form-add-resource">Add</button>
            </div>
        </div>
    </div>
</div>
<div id="modal-edit-resource" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="media">
                    <div class="media-body">
                        <form action="" method="post" id="form-edit-resource">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Resource name: </span>
                                    <input type="text" class="form-control" name="resource_name" value="">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" form="form-edit-resource">Save</button>
            </div>
        </div>
    </div>
</div>

<script>

    $('.btn-edit-resource').on('click',function (e) {
        var btn=e.currentTarget;
        var resource_id=$(btn).data("resource_id");
        $.ajax({
            url: "/admin/viewresource/"+resource_id,
            type: 'POST',
            success : function (data){
                var data_resource=JSON.parse(data);

                $("#form-edit-resource input[name='resource_name']").val(data_resource['resource_name']);
                $("#form-edit-resource").attr('action','/admin/editresource/'+data_resource['resource_id']);
            }
        });
    });

</script>