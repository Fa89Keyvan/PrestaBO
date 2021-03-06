<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-rtl.min.css" rel="stylesheet">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/sb-admin-rtl.css" rel="stylesheet">
    <link href="css/plugins/morris.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="Kendo/styles/kendo.common.min.css" rel="stylesheet">
    <link href="Kendo/styles/kendo.default.min.css" rel="stylesheet" />
    <link href="Kendo/styles/kendo.rtl.min.css" rel="stylesheet" />

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--<script src="Kendo/js/kendo.all.min.js"></script>-->
    <script src="Kendo/js/kendo.web.min.js"></script>

    <script src="Kendo/js/messages/kendo.messages.fa-IR.min.js"></script>
    <script src="js/helpers.js"></script>

</head>

<body>

    <div id="wrapper">

        <span id="plcSideBar"></span>

        <div id="page-wrapper">
            <div class="panel panel-primary" id="panel">
                <div class="panel-heading">
                    <button class="btn btm-default text-primary pull-left" id="btnMaximize">بزرگنمایی</button>
                    <button class="btn btm-default text-primary pull-left hide" id="btnRestore">کوچکنمایی</button>
                    <span id="plcTitle"></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12" id="plcBody"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" role="dialog">
        <div class="modal-body">
            <div class="panel panel-success">
                <div class="panel-heading" id="plcModalHeading"></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12" id="plcModalBody">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="loading"></div>
    <script src="js/app.js?1"></script>
</body>
</html>
