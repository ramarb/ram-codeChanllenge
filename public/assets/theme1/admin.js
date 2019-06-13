$(document).ready(function(){

    $("[name='form[]']").on('click',function(){
        var thisValue = $(this).val();
        //alert(thisValue);
        $("[name='form[]']").each(function(){
            if($(this).val() !== thisValue){
                $(this).prop('checked',false);
            }
        });
    });

    $("[name='gallery[]']").on('click',function(){
        var thisValue = $(this).val();
        //alert(thisValue);
        $("[name='gallery[]']").each(function(){
            if($(this).val() !== thisValue){
                $(this).prop('checked',false);
            }
        });
    });


    $("#dummy-keyword").on('keyup',function () {
        $('input[name="keyword"]').val($(this).val());
    });

    $("#dummy-keyword").on('keypress',function () {
        if (event.which === 13 || event.keyCode === 13) {
            //code to execute here
            //return false;
            $("#submit-search").trigger('click');
        }
    });

    $("#clear-search").on('click',function(){
        $('input[name="keyword"]').val('');
        $("#dummy-keyword").val('');
        $("#submit-search").trigger('click');
    });

    $("#submit-search").on('click',function(){
        $("#search-list").submit();
    });

    if(successMessage !== ''){
        $("#alert-message").html(successMessage);
        $("#flash-message-trigger").click();
    }

    $("#logout-but").on('click',function(e){
        e.preventDefault();
        $("#logout-form").submit();
    });

    $("#back-button").on('click',function (e) {
        e.preventDefault();
        window.history.back();
    });

    $(".delete-this").on('click',function(e){
        e.preventDefault();
        //alert($(this).attr('href'));
        var href = $(this).attr('href');

        var id = $(this).data('id');

        if(confirm('Are you sure you want to delete this record?')){
            $('#delete-record input[name="id"]').val(id);
            $("#delete-record").attr('action',href).submit();
        }

    });


    $("#add-contents").on('click',function(){

        var selected_content = '';

        var disabled = '';

        var i = 0;

        $('input[name="content[]"], input[name="form[]"], input[name="gallery[]"]').each(function(){

            disabled = 'value="'+i+'"';

            if($(this).is(':checked')){

                if($(this).data('contenttype') !== 'Inner' && $(this).data('contenttype') !== 'Form' && $(this).data('contenttype') !== 'Gallery'){
                    disabled = 'value=""';
                }else{
                    i++;
                }

                var title = $(this).data('title');
                var contenttype = $(this).data('contenttype');
                var input_name = 'content_id[]';

                if($(this).data('contenttype') === 'Form'){
                    input_name = 'form_id[]';
                }else if($(this).data('contenttype') === 'Gallery'){
                    input_name = 'gallery_id[]';
                }

                /*selected_content += ''+
                    '<li class="list-group-item">' +
                    '<div class="input-group mb-3">' +
                    '<div class="input-group-prepend">' +
                    '<span class="input-group-text" style="width: 79px">'+contenttype+'</span>' +
                    '<span class="input-group-text" style="width: 473px">'+title+'</span>' +
                    '</div>' +
                    '<input type="hidden" name="'+input_name+'" value="'+$(this).val()+'">' +
                    '<input type="number" name="content_order[]" class="form-control" '+disabled+' aria-label="" placeholder="" >' +
                    '</div>' +
                    '</li>';*/

                var link = '';
                
                if(contenttype === 'Form'){
                    link = base_url + '/admin/forms/'+ $(this).val() + '/edit';
                }else if(contenttype === 'Gallery'){
                    link = base_url + '/admin/galleries/'+ $(this).val() + '/edit';
                }else if(contenttype === 'Inner'){
                    link = base_url + '/admin/contents/'+ $(this).val() + '/edit';
                }

                if(link !== ''){
                    link = ''+
                        '<a href="'+link+'" target="_blank" class="float-left">' +
                        '<svg class="feather feather-edit-3 sc-dnqmqq jxshSx" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" data-reactid="496"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>' +
                        '</a>';
                }

                selected_content += ''+
                    '<li class="list-group-item">' +
                        '<div class="row">' +
                        '<div class="col col-lg-10">' +
                        '<div class="input-group mb-3">' +
                        '<div class="input-group-prepend">' +
                        '<span class="input-group-text" style="width: 79px">'+contenttype+'</span>' +
                    '<span class="input-group-text" style="width: 473px">'+title+'</span>' +
                    '</div>' +
                    '<input type="hidden" name="'+input_name+'" value="'+$(this).val()+'">' +
                    '<input type="number" name="content_order[]" class="form-control" '+disabled+' aria-label="" placeholder="" >' +

                        '</div>' +
                        '</div>' +
                        '<div class="col col-lg-1">'+link+'</div>' +
                    '</div>' +
                    '</li>';
            }

            $("#selected-content").html(selected_content);

            $("[data-dismiss=modal]").trigger({ type: "click" });

        });

    });

    /*$("#add-form-page").on('click',function(){
        var page_count = $("#page-count").val();
        var btns = "";
        page_count++;

        $("#page-count").val(page_count);

        for(var i = 1; i <= page_count; i++){
            btns += '<input type="button" style="margin: 0 3px" class="btn" value="Page '+i+'">';
        }

        $(".btn-wrapper").html(btns);

    });*/

});

