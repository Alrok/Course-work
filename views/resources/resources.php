<div class="container">
    <div id="resource-list">
        <?php
            if($data==='not-access'){
                echo "<div class='alert alert-warning text-center'>Нужна авторизация!!!</div>";
            }
            if(empty($data)){
                echo "<div class='alert alert-info text-center'>Нет доступных ресурсов.</div>";
            }
        ?>
        <div class="row">
            <?php if(!empty($data)&&$data!=='not-access'){foreach ($data as $key=>$value){?>
                <div class="col-md-6 col-xs-12">
                    <div class="thumbnail">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <img alt="100%x200" data-src="holder.js/100%x200" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMjQyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDI0MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTU4NmNkMGJjMTEgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMnB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNTg2Y2QwYmMxMSI+PHJlY3Qgd2lkdGg9IjI0MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI4OS44MDQ2ODc1IiB5PSIxMDUuMSI+MjQyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="caption">
                                    <p><span class="label label-info"><?=$data[$key]['group_name']?></span></p>
                                    <h3><?=$data[$key]['resource_name']?></h3>
                                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                                    <p style="text-align: right"><button class="btn btn-primary btn-view-resource" role="button" data-resource_id="<?=$data[$key]['resource_id']?>">View</button></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php }} ?>
        </div>
    </div>
</div>
<script>
    $('.btn-view-resource').on('click',function (e) {
        var btn=e.currentTarget;
        var resource_id=$(btn).data("resource_id");
        $.ajax({
            url: "/resources/viewresource/"+resource_id,
            type: 'POST',
            success : function (data){
                console.log(data);
                var data_resource=JSON.parse(data);
                alert(data_resource['resource_name']);
            }
        });
    });
</script>