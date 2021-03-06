

<div class="k-rtl">
    <div id="grdPerson"></div>
</div>

<script>
    $(document).ready(function(){
        setPanelHeading('لیست مشتریان در فرمت حسابفا');
        $('#grdPerson').kendoGrid({

            dataSource:{
                transport:{
                    read:{
                        url:'../../PrestaBO/Server/Api/Api.php?q=HfContacts_GetAll',
                        dataType: 'json',
                        data:{q:'getAll',token:getLocalToken().Token},
                        method: 'POST'
                    }
                },
                batch: true,
                pageSize: 10,
                
            },
            pageable: { pageSizes: [10, 20, 50, 200, 1000] },
            scrollable: true,
            height:450,
            groupable:true,
            sortable:true,
            filterable: true,
            columns:[
                {field: 'ID',title:'ش'},
                {field: 'Code',title:'ح.س'},
                {
                    field: 'Code',
                    title:'حسابفا',
                    template:function(dataRow)
                    {
                        var fa = (dataRow.Code === -1) ? 'fa-times-circle text-danger' : 'fa-check-circle text-primary';
                        var template = '<i class="fa ' + fa + '"></i>';
                        template += '<a class="showFormHfContact" data-Code="' + dataRow.Code + '" data-ID="' + dataRow.ID + '"><i class="fa fa-arrow-circle-up text-primary"></i></a>';
                        return template;
                    },
                    groupable:false,
                    filterable:false
                },
                {field:'FirstName',title:'نام'},
                {field:'LastName',title:'نام خانوادگی'},
                {field:'Mobile',title:'مبایل'},
                {field:'City',title:'شهر'},
                {field:'State',title:'استان'}
                
            ],

        });

    });

    $(document).on('click', '.showFormHfContact', function () {
        var id = $(this).attr('data-id');

        $.get('Forms/FrmHfContact.php', function (data, status) {
            showModal(data);
        });
        var token = getLocalToken().Token;
        $.ajax({
            url: apiBaseUrl + '?q=HfContact_Get',
            data: { token: token, id: id },
            method: 'POST',
            success: function (data) {
                var hfContact = JSON.parse(data);
                for (var p in hfContact) {
                    //console.log(hfContact[p]);
                    $('input[name=' + p + ']').val(hfContact[p]);
                }
            }
        })
    });

</script>