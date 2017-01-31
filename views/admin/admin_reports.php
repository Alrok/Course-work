

<div class="panel-group" id="collapse-group">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#report1" class="btn btn-default btn-collapsed" data-toggle="collapse" data-parent="#collapse-group">Количество зарегистрированных за период</a>
            </h4>
        </div>
        <div id="report1" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <form id="report1-form" action="" class="well well-sm">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">From: </span>
                                    <input type="date" class="form-control" name="period_from" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">To: </span>
                                    <input type="date" class="form-control" name="period_to" value="">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">View</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default" id="report1-result" style="display: none">
                    <div class="panel-heading">
                        <h4>Result</h4>
                    </div>
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th>Users</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#report2" id="report2-btn" data-toggle="collapse" data-parent="#collapse-group" class="btn btn-default btn-collapsed">Активность пользователя за период</a>
            </h4>
        </div>
        <div id="report2" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <form id="report2-form" action="" class="well well-sm">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">User: </span>
                                    <input type="text" class="form-control" name="user_login" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">From: </span>
                                    <input type="date" class="form-control" name="period_from" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">To: </span>
                                    <input type="date" class="form-control" name="period_to" value="">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">View</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default" id="report2-result" style="display: none">
                    <div class="panel-heading">
                        <h4>Result</h4>
                    </div>
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>User</th>
                            <th>Resources</th>
                            <th>Views</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#report3" id="report3-btn" data-toggle="collapse" data-parent="#collapse-group" class="btn btn-default btn-collapsed">Получение доступа за период</a>
            </h4>
        </div>
        <div id="report3" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <form id="report3-form" action="" class="well well-sm">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Group: </span>
                                    <input type="text" class="form-control" name="group_name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">From: </span>
                                    <input type="date" class="form-control" name="period_from" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">To: </span>
                                    <input type="date" class="form-control" name="period_to" value="">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">View</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default" id="report3-result" style="display: none">
                    <div class="panel-heading">
                        <h4>Result</h4>
                    </div>
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Group</th>
                            <th>Resources</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="#report4" id="report3-btn" data-toggle="collapse" data-parent="#collapse-group" class="btn btn-default btn-collapsed">Количество пользователей добавленных в группу за период</a>
            </h4>
        </div>
        <div id="report4" class="panel-collapse collapse">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <form id="report4-form" action="" class="well well-sm">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Group: </span>
                                    <input type="text" class="form-control" name="group_name" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">From: </span>
                                    <input type="date" class="form-control" name="period_from" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">To: </span>
                                    <input type="date" class="form-control" name="period_to" value="">
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary">View</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-default" id="report4-result" style="display: none">
                    <div class="panel-heading">
                        <h4>Result</h4>
                    </div>
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Group</th>
                            <th>Users</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#report1-form').on('submit',function (e) {
        e.preventDefault();
        var data_input=$('#report1-form').serialize();
        $.ajax({
            url: "/admin/amountuserperiod",
            data: data_input,
            type: 'GET',
            success : function (data){
                var data_result=JSON.parse(data);
                $('#report1-result').css('display','block');
                $('#report1-result table tbody').append("<tr><td>"+data_result["period_from"]+"</td><td>"+data_result["period_to"]+"</td><td>"+data_result["amount_users"]+"</td></tr>");
            }
        });
    });
    
    $('#report2-form').on('submit',function (e) {
        e.preventDefault();
        var data_input=$('#report2-form').serialize();

        $.ajax({
            url: "/admin/amountviews",
            data: data_input,
            type: 'GET',
            success : function (data){
                var data_result=JSON.parse(data);
                $('#report2-result table tbody').html("");
                $('#report2-result').css('display','block');
                $('#report2-result table tbody').append("<tr><th>User</th><th>Resources</th><th>Views</th></tr>");
                for(var prop in data_result)
                {
                    $('#report2-result table tbody').append("<tr><td>"+data_result[prop]["user_login"]+"</td><td>"+data_result[prop]["resource_name"]+"</td><td>"+data_result[prop]["views"]+"</td></tr>");
                }

            }
        });
    });
    $('#report3-form').on('submit',function (e) {
        e.preventDefault();
        var data_input=$('#report3-form').serialize();

        $.ajax({
            url: "/admin/groupaccess",
            data: data_input,
            type: 'GET',
            success : function (data){
                var data_result=JSON.parse(data);
                $('#report3-result table tbody').html("");
                $('#report3-result').css('display','block');
                $('#report3-result table tbody').append("<tr><th>Group</th><th>Resources</th></tr>");
                for(var prop in data_result)
                {
                    $('#report3-result table tbody').append("<tr><td>"+data_result[prop]["group_name"]+"</td><td>"+data_result[prop]["resource_name"]+"</td></tr>");
                }

            }
        });
    });
    $('#report4-form').on('submit',function (e) {
        e.preventDefault();
        var data_input=$('#report4-form').serialize();

        $.ajax({
            url: "/admin/addingroup",
            data: data_input,
            type: 'GET',
            success : function (data){
                var data_result=JSON.parse(data);
                console.log(data_result);
                $('#report4-result table tbody').html("");
                $('#report4-result').css('display','block');
                $('#report4-result table tbody').append("<tr><th>Group</th><th>Users</th></tr>");
                $('#report4-result table tbody').append("<tr><td>"+data_result["group_name"]+"</td><td>"+data_result["amount_users"]+"</td></tr>");


            }
        });
    });
</script>