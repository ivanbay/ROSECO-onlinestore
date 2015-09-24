$(function() {
    
    var base_url = window.location.protocol + "//" + window.location.host + "/ecommerce/public";
    var delete_id = new Array();
    

    /* Set status on load */
    $(document).ready(function(){

        $('#records_tbl').DataTable( {
            "iDisplayLength": 10,   //records per page
            "sort": false,
            "sPaginationType": "bootstrap",
            initComplete: function () {
                var api = this.api();
     
                api.columns().indexes().flatten().each( function ( i ) {
                    var column = api.column( i );
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
     
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
     
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );


        $('.datatable').DataTable( {
            "iDisplayLength": 10,   //records per page
            "sort": false,
            "sPaginationType": "bootstrap",
            initComplete: function () {
                var api = this.api();
     
                api.columns().indexes().flatten().each( function ( i ) {
                    var column = api.column( i );
                    var select = $('<select><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
     
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
     
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );

        var formTable = $('.simple_datatable').DataTable( {
            "iDisplayLength": 10,   //records per page
            "sort": false,
            "sPaginationType": "bootstrap",
        } );


        var parts = 0;

        /* add parts link */
        $('#customize_div').on('click', '.add_parts', function()
        {
            parts++;

            $appendRow = '<div id="part_' + parts + '" style="margin: 0 0 40px 0;">\
                        <div class="form-group"><hr>\
                            <div class="pull-right">\
                                <a class="remove_part"><i class="glyphicon glyphicon-remove"></a></i>\
                            </div>\
                            <div class="label_div2">\
                                <div class="label_text">Part name:</div>\
                            </div>\
                            <div class="col-sm-8">\
                                <input type="text" name="part_name[' + parts + ']" class="formInputs form-control input-sm" id="part_name">\
                            </div>\
                        </div>\
                        \
                        <div class="form-group">\
                            <div class="label_div2">\
                                <div class="label_text">\
                                    [ <a id="add_choices" part_no="' + parts + '" rel="tooltip" data-toggle="tooltip" data-placement="top" title="Click to add more choices."><i class="glyphicon glyphicon-plus"></i></a> ] Choices:\
                                </div>\
                            </div>\
                        </div>\
                    </div>';

            $( "#customize_div" ).append( $appendRow );

            
        });


        $("#customize_div").on("click", ".remove_part", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').parent('div').remove(); 
            parts--;
        });

        $('#customize_div').on("click", '#add_choices', function()
        {
            var part_no = $(this).attr('part_no');

            $appendChoices = "<div class='form-group'>\
                                <div class='pull-right'>\
                                    <a class='remove_choice'><i class='glyphicon glyphicon-remove'></a></i>\
                                </div>\
                                <div class='label_div2'>\
                                    <i class='glyphicon glyphicon-pushpin'></i>\
                                </div>\
                                <div class='col-sm-8'>\
                                    <div style='width: 200px;' class='pull-left'>\
                                        <div class='label_text'><input type='text' name='part_choices_name[" + part_no + "][]' class='formInputs form-control input-sm' placeholder='Name'></div>\
                                    </div>\
                                    <div style='width: 130px;'>\
                                        <div class='label_text'><input type='text' name='part_choices_cost[" + part_no + "][]' class='formInputs form-control input-sm' placeholder='Cost'></div>\
                                    </div>\
                                    <div style='margin: 0 0 5px 0;'></div>\
                                    <div class='pull-left'><b>Image:</b> &nbsp;</div><input type='file' name='part_choices[" + part_no + "][]' multiple='1'>\
                                </div>\
                            </div>";

            $( "#part_" + part_no ).append( $appendChoices );

        });

        $("#customize_div").on("click", ".remove_choice", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').parent('div').remove();
        });


        /* edit: add new image */
        $('#product_image_div').on("click", '.add_image', function()
        {
            var part_no = $(this).attr('part_no');

            $appendImage = "<div class='form-group'>\
                                <a class='remove_image'><i class='glyphicon glyphicon-remove'></a></i>\
                                <div class='col-sm-8'>\
                                    <input type='file' name='product_image[]' multiple='1'>\
                                </div>\
                            </div>";

            $( "#product_image_div" ).append( $appendImage );

        });

        $("#product_image_div").on("click", ".remove_image", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').remove();
        });


        /* edit: add new choices */
        $('#customize_div').on("click", '#add_new_choices', function()
        {
            var part_id = $(this).attr('part_id');

            $appendChoices = "<div class='form-group'>\
                                <div class='pull-right'>\
                                    <a class='remove_choice'><i class='glyphicon glyphicon-remove'></a></i>\
                                </div>\
                                <div class='col-sm-8'>\
                                    <div style='width: 200px;' class='pull-left'>\
                                        <div class='label_text'><input type='text' name='part_choices_name[" + part_id + "][]' class='formInputs form-control input-sm' placeholder='Name'></div>\
                                    </div>\
                                    <div style='width: 130px;'>\
                                        <div class='label_text'><input type='text' name='part_choices_cost[" + part_id + "][]' class='formInputs form-control input-sm' placeholder='Cost'></div>\
                                    </div>\
                                    <div style='margin: 0 0 5px 0;'></div>\
                                    <div class='pull-left'><b>Image:</b> &nbsp;</div><input type='file' name='part_choices[" + part_id + "][]' multiple='1'>\
                                </div>\
                            </div>";

            $( "#part_" + part_id ).append( $appendChoices );

        });

        $("#customize_div").on("click", ".remove_choice", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent('div').remove();
        });

        
        
    });
    
    /* tooltip */
    $('[rel=tooltip]').tooltip({
        placement: 'top'
    });
    
        
    $('.dropdown-toggle').dropdown();

	$('.alert-notification').fadeOut(5000);	

    
    /* date picker */
    $('.datepicker').datetimepicker({
        i18n:{
            de:{
                months:[
                    'Januar','Februar','März','April',
                    'Mai','Juni','Juli','August',
                    'September','Oktober','November','Dezember',
                   ],
                dayOfWeek:[
                    "So.", "Mo", "Di", "Mi", 
                    "Do", "Fr", "Sa.",
                   ]
                }
         },
         timepicker:false,
         format:'d.m.Y'
    
    });
    
            
    /* multiple row selection */
    $('.delete_enable_tbl tbody').on( 'click', 'tr', function () {

        var selected_id = $(this).closest('tr').attr('id');
        var table = $(this).closest('tr').attr('table');
        var arr = new Array();

        var tr = $(this).closest('tr');
        var row = formTable.row( tr );

        row.child.hide();

        if( $(this).hasClass('selected') ){
            $(this).removeClass('selected');

            delete_id.splice($.inArray(selected_id, delete_id),1); //remove value from array

        } else {
            $(this).addClass('selected');
            delete_id.push(selected_id);
        }

    } );
 

    /* delete button (multiple) */
    $('.delete_selected').on('click', function(){
        
        var table = $(this).attr('table');
        var id_count = delete_id.length;

        if( id_count === 0 ){
            bootbox.alert("No items selected.");
            return false;
        }

        bootbox.confirm("Are you sure you want to delete " + id_count + " item(s)?", function(result) {

            if(result == true){

                //$.each(delete_id, function( index, value ) {

                    $.ajax({
                            type: "POST",
                            url : base_url + "/delete",
                            data : {
                                ids: delete_id,
                                table: table
                            },
                            success : function(data){

                                if( data == 'true' )
                                {
                                    window.location.reload();
                                }
                                else
                                {
                                    alert(data);
                                }
                                
                            }
                        },"json");

                //});

            }

        });
        
    });

    
 
	$('.close_form').click(function(){
        $('form').trigger('reset');
        $('#available_stock_div').hide();
        $('#new_stocks_div').hide();	
    });



    $('table#products_tbl tr.product_list').dblclick(function(){

        var prod_id = $(this).closest('tr').attr('id');
        var cat_id = $(this).closest('tr').attr('cat_id');

        var $tr = $(this).closest('tr').children('td');
        var prod_name = $tr.eq(0).text();
        var prod_desc = $tr.eq(1).text();
        var reorder_level = $tr.eq(2).text();

        $('#editProductForm').modal('toggle');

        $('.selectpicker').selectpicker('val', cat_id);
        $('#product_id').val(prod_id);
        $('#product_name').val(prod_name);
        $('#product_desc').val(prod_desc);
        $('#reorder_level').val(reorder_level);

    });

    

    $('select#product_id').on('change', function() {

        product_id = $(this).val();

        $('#available_stock_div').show();
        $('#stock_available').text('Checking stock availability...');

        $.ajax({
            type: "POST",
            url : base_url + "/delivery/checkstock",
            data : {
                id: product_id
            },
            success : function(data){

                $('#stock_available').text(data);

            }
        },"json");

        if( product_id != '' )
        {
            $('#delivery_qty').prop('disabled', false);
        } else {
            $('#delivery_qty').prop('disabled', true);
            $('#available_stock_div').hide();
        }


    });


    $(document).on('change', '.product_check', function() {

        var input = $(this).closest('div#product').children('input');

        if( $(this).is(":checked"))
        {
            input.show().prop("disabled", false);
        } else {
            input.hide().prop("disabled", true);
            input.val("");
            $(this).closest('div#product').children('div.error').hide();
        }

    }); 

    var errors = 0;
    $(document).on('keyup', '#deliver_qty', function(){

        qty = $(this).val();    
        product_id = $(this).attr('prod_id');

        error_div = $(this).closest("div").children('div.error');

        error_div.text('Computing available stocks..');

        $.ajax({
            type: "POST",
            url : base_url + "/delivery/computestock",
            data : {
                product_id: product_id,
                qty: qty
            },
            success : function(data){

               if( data < 0 )
               {
                    error_div.text('Quantity exceeds available stocks.');
                    $('.delivery_save').prop('disabled', true);
                    $('.save_error').show();
                    errors++;
               } 
               else 
               {
                    error_div.text('Available stocks after delivery: ' + data);
                    $('.delivery_save').prop('disabled', false);
                    $('.save_error').hide();
               }

            }
        },"json");


    });

    
    var errors = 0;
    $(document).on('keyup', '#return_qty', function(){

        qty = $(this).val();    
        product_id = $(this).attr('prod_id');

        error_div = $(this).closest("div").children('div.error');

        error_div.text('Computing available stocks..');

        $.ajax({
            type: "POST",
            url : base_url + "/delivery/computereturn",
            data : {
                product_id: product_id,
                qty: qty
            },
            success : function(data){
               
                error_div.text('Available stocks after return: ' + data);
                $('.delivery_save').prop('disabled', false);
                $('.save_error').hide();

            }
        },"json");


    });


    $('.btntry').click(function(){
        
        var values = new Array();

        $("input[name='qty[]']").each(function(){
            values.push($(this).val());
        });

        var newValues = values.filter(function(v){return v!==''});

        var total = 0;
        for (var i = 0; i < newValues.length; i++) {
            total += newValues[i] << 0;
        }

        console.log(newValues);
        alert(total);

    });


    $('.approve_btn').on('click', function(){

        var id = $(this).attr('id');

        bootbox.confirm("You are about to approve the returned orders. Once you approve this, you cannot cancel the approved returned orders. Continue?", function(result) {

            if(result == true){

                $.ajax({
                    type: "POST",
                    url : base_url + "/delivery/approvereturn",
                    data : {
                        id: id
                    },
                    success : function(data){
                        
                        if( data == 'ok' )
                        {
                            window.location.reload();
                        }

                    }
                },"json");

            }
        });

    });


    $('.cancel_btn').on('click', function(){

        var id = $(this).attr('id');

        bootbox.confirm("Cancel returned orders, continue?", function(result) {

            if(result == true){

                $.ajax({
                    type: "POST",
                    url : base_url + "/delivery/return/0",
                    data : {
                        id: id
                    },
                    success : function(data){

                        if( data == 'ok' )
                        {
                            window.location.reload();
                        }

                    }
                },"json");

            }
        });

    });

    $('.return_btn').on('click', function(){

        var id = $(this).attr('id');

        bootbox.confirm("Return orders, continue?", function(result) {

            if(result == true){

                $.ajax({
                    type: "POST",
                    url : base_url + "/delivery/return/1",
                    data : {
                        id: id
                    },
                    success : function(data){

                        if( data == 'ok' )
                        {
                            window.location.reload();
                        }

                    }
                },"json");

            }
        });

    });


    $('.delivered_btn').on('click', function(){

        var id = $(this).attr('id');

        bootbox.confirm("This will set the status to DELIVERED. Once the status set to DELIVERED, you cannot change it anymore. Continue?", function(result) {

            if(result == true){

                $.ajax({
                    type: "POST",
                    url : base_url + "/delivery/delivered",
                    data : {
                        id: id
                    },
                    success : function(data){

                        if( data == 'ok' )
                        {
                            window.location.reload();
                        }
                        

                    }
                },"json");

            }
        });

    });


    $('.view_orders_btn').click(function(){

        var id = $(this).attr('id');

        $('#myModal').modal('toggle');

    });


    $('table#userTable tr.user_row').dblclick(function(){

        var id = $(this).closest('tr').attr('id');

        var $tr = $(this).closest('tr').children('td');
        var username = $tr.eq(0).text();
        var usertype = $tr.eq(1).text();

        if( $.trim(usertype) == 'Admin' )
        {
            var type = '1';
        } else {
            var type = '0';
        }

        $('form#editUserForm #username').val(username);
        $('form#editUserForm input[name="userid"]').val(id);

        $('.selectpicker').selectpicker('val', type);
        $('#editUserForm').modal('toggle');

    });

    $('.delivery_row td:not(:last-child)').click(function(){

        var id = $(this).closest('tr').attr('id');

        window.location = "delivery/invoice/" + id;
    });



    /* ############ Common classes ############# */

    /* data tables */    
    var formTable = $('#usersTable').DataTable({
            "iDisplayLength": 50,   //records per page
            "sPaginationType": "bootstrap"
        });



    /* single delete */
    $(document).on("click", ".delete_item", function(e) {
            
        var id = $(this).attr('id');
        var table = $(this).attr('table');
        
        
        if ( $(this).hasClass('to_delete') ) {
            
            $(this).removeClass('to_delete');
        
        } else {
        
            $($(this).parents('tr')).addClass('to_delete');
            
        }


        bootbox.confirm("Are you sure you want to delete?", function(result) {

            if(result == true){
                
               $.ajax({
                    type: "POST",
                    url : base_url + "/delete",
                    data : {
                        ids: id,
                        table: table
                    },
                    success : function(data){
                        window.location.reload();
                    }
                },"json");
                
            } 
            
        }); 

    });


    $('.save_button').on('click', function(e){

        var btn = $(this);
        var form = $(this).closest('form');
        btn.button('loading');
        setTimeout(function () {
            
            btn.button('reset');
            form.submit();
            $('.close').click();
            console.log(form);

        }, 1000);

    })


    $('.gen_report_btn').on('click', function(){

        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();

        if( date_from == '' )
        {
            $("#error_msg").html('Error: All fields are requried.');
            return false;
        } 
        else if( date_to == '' )
        {
            $("#error_msg").html('Error: All fields are requried.');
            return false;
        }
        else
        {
            $("#error_msg").html('');
            $(this).closest('form').submit();
        }

    });


    $('[type=checkbox][name=customizable]').click(function()
    {
        if( $(this).is(":checked"))
        {
            $('#customize_div').show();
        } else {
            $('#customize_div').hide();
        }

    });

    $('[type=checkbox][name=read_terms]').click(function()
    {
        if( $(this).is(":checked"))
        {
            $('.register_btn').prop("disabled", false);
        } else {
            $('.register_btn').prop("disabled", true);
        }

    });

    $('.customer_cancel_order').on('click', function()
    {
        var order_id = $(this).attr('id');

        bootbox.confirm("Are you sure you cancel your order?", function(result) {

            if(result == true){

                $.ajax({
                    type: "POST",
                    url : base_url + "/order/cancel",
                    data : {
                        order_id: order_id
                    },
                    success : function(data){
                        
                        if( data == 'true' )
                        {
                            window.location.reload();
                        }
                        else
                        {
                            alert('Unsuccesful transaction.');
                        }
                    }
                },"json");

            }

        });
        
    })

    $('#cancelOrder').click(function()
    {
        var order_id = $(this).attr('order_id');
        $('input[name=cancel_order_id]').val(order_id);
        $('textarea[name=cancelation_reason]').val('');
    });
      

    $('.cancel_order_btn').click(function()
    {

        var reason = $('textarea[name=cancelation_reason]').val();
        
        if( reason == "" )
        {
            $('#error_div').text('Please provide a reason for cancelation');
        }
        else if( reason.length > 150 )
        {
            $('#error_div').text('Reason is maximum of 150 characters only.');   
        }
        else
        {
            var btn = $(this);
            var form = $(this).closest('form');
            btn.button('loading');
            setTimeout(function () {
                
                btn.button('reset');
                form.submit();
                $('.close').click();

            }, 1000);
        }

    })

    $('.btn_trash').click(function()
    {

        var id = $(this).attr('order_id');

        bootbox.confirm("Are you sure you want to move this order to trash?", function(result) {

            if(result == true){

                $.get( base_url + "/admin/orders/process/delete/" + id, function( data ) {
                    window.location = base_url + "/admin/orders/list/deleted";
                });

            }

        });
    })

    
}); // function


/* hicharts */
$(function () {

    var base_url = window.location.protocol + "//" + window.location.host + "/ecommerce/public";
    
    var options = {
        chart: {
            renderTo: 'highcharts_container',
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'ROSECO Marketing Venture delivered orders for the year ' + (new Date).getFullYear()
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: ''
        }]
    };

    $.getJSON(base_url + "/admin/orders/genreport", function(data) {
        options.series[0].data = data;
        var chart = new Highcharts.Chart(options);
    });

   


    /* Report Graph */

    var options2 = {
        chart: {
            renderTo: 'report_graph',
            type: 'column',
            marginTop: 80,
            marginRight: 40
        },

        title: {
            text: 'ROSECO Marketing Venture sales report ' + (new Date).getFullYear()
        },

        xAxis: {
            categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            crosshair:true
        },

        yAxis: {
            allowDecimals: false,
            min: 0,
            title: {
                text: ''
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },

        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },

        series: [{
            stack: 'male'
        }, {
            stack: 'male'
        }, {
            stack: 'female'
        }, {
            stack: 'female'
        }]
    };

    $.getJSON(base_url + "/admin/report/genreport", function(data) {
        //options.series[0].data = data;
        var i = 0;
        $.each(data, function(key, value){
            //console.log(key);
            options2.series[i].name = key;
            options2.series[i].data = value;
            i++;
        });
        var chart = new Highcharts.Chart(options2);
    });

    
});

/*$(document).ready(function(){

    $('input').iCheck({
         checkboxClass: 'icheckbox_square-blue'
    });

});*/

