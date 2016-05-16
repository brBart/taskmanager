@extends('layout')

@section('breadcrumbs_title')
    Create project
@stop


@section('content')

     <div class="row widget-bg-color-white no-space margin-bottom-20">
              <form role="form" id="projects" name="projects">
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        	<div class="portlet-body form">
                                  
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Enter your name">
                                            <label for="form_control_1">Project name</label>                
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your name">
                                            <label for="form_control_1">Contact email</label>                
                                        </div>
                                       
                                    </div>
                                    <!--<div class="form-actions noborder">
                                        <button type="button" class="btn blue">Submit</button>
                                        <button type="button" class="btn default">Cancel</button>
                                    </div>-->
                                   
                                </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        <div class="portlet-body form">
                                  
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter your name">
                                                <label for="form_control_1">Contact name</label>                
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your name">
                                                <label for="form_control_1">Contact phone</label>                
                                            </div>
                                           
                                        </div>
                                        <!--<div class="form-actions noborder">
                                            <button type="button" class="btn blue">Submit</button>
                                            <button type="button" class="btn default">Cancel</button>
                                        </div>-->
                                   
                                </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
             

                         <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group">
         
                                       <div id="preview" style="background: url(/assets/apps/img/photos/preview.png);  background-repeat: no-repeat;" class="widget-gradient margin-top-20">
                                    </div>

                                    <input name="photo" type="file" id="photo" name="photo" />
                            
                            </div>
                        </div>
                  </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
        <div class="col-md-12 col-sm-12 no-space margin-20">
                  <div class="portlet-body form">
                       
                         <div class="form-body">
                          

                             <div class="form-body">
                            <div class="form-group">
                                <label>This project is manage by all people in this company</label>
                                <div class="input-group">
                                    <div class="icheck-inline">
                                        @foreach ($companies as $company)   
                                            @if($company->name != "" )                                         
                                                <label>
                                                <input type="checkbox" id="company_id_{{ $company->id }}" name="company_id_{{ $company->id }}" class="project-manager company icheck"> {{ $company->name}} </label>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>


                        </div>

                </div>
        </div> 


           <div class="col-md-12 col-sm-12 no-space margin-20">  
                  <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group">
                                <label>Manage by</label>
                                <div class="input-group">
                                    <div class="icheck-inline">
                                        @foreach ($users as $user)  
                                            @if($user->first_name.$user->last_name != "")                                          
                                                <label>
                                                <input type="checkbox" id="user_id_{{ $user->id }}" name="user_id_{{ $user->id }}" class="project-manager user icheck"> {{ $user->first_name}} {{ $user->last_name}} </label>
                                            @endif
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
        </div> 




        </form>
                     
    </div>

@stop



@section('javascripts')



<script>


     var item_id = 0; 
     var role =0;
     var company_id = 0;
     var project_id = 0;
     var table = '';
     var  url = "/save/data";
     var class_name = '';
     var data = '';

      $("input, select").focusout(function(event) {
        var input_type = $(this).attr('type');

        if(input_type != 'file'){

               var field = $(this).attr('name');
               var $form = $('input[name="'+field+'"] ,select[name="'+field+'"]').closest("form");
               table = $form.attr('name');
               var value = $('#'+field).val();

               class_name = $(this).attr('class');
               url = "/save/data";
               data = {'id':item_id, 'table': table, 'field' : field , 'value' : value};
               if(class_name.indexOf('project-manager') > -1){
                    table = 'managers';
                    url = '/save/project/manager';

                    if(field.indexOf('company_id_') > -1 )
                    {
                        user_id = 0;
                        company_id = field.replace("company_id_","");
                    }


                    if(field.indexOf('user_id_') > -1 )
                    {
                        company_id = 0;
                        user_id = field.replace("user_id_","");
                    }


                    if($(this).is(':checked'))
                        manager = 1;
                    else
                        manager = 0;

                    data = { 'table': table, 'project_id' : project_id , 'company_id' : company_id , 'user_id' : user_id , 'manager' : manager};
               }


                if((typeof value !== 'undefined') && ( value.length >= 1)){
                
                    $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });

                    $(".saving-"+field).css('display','block'); 
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: data,
                        cache: false,
                        success: function(data){
                            if(data["response"]["status"] == 'success'){
                                item_id = data["response"]["id"];
                                project_id = item_id;
                                $('#'+table+' .result-message').html(' saved....');
                                $(".saving-"+field).html('<i class="fa fa-check font-green"></i>');        
                                $(".saving-"+field).delay(2000).fadeIn('slow');
                                $(".saving-"+field).delay(2000).fadeOut('slow');

                            }else{
                                $(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                        
                            }
                           return data;
                        }
                    }).error(function(data){
                        $(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                    });
                }else{
                    $(".saving-"+field).html('<i class="fa fa-warning font-red"></i>');
                }
        }
        
    });




    var file = document.querySelector("form");
    var request = new XMLHttpRequest();

    $('#photo').change(function(){
        $('#preview').css('background-image', 'url("/assets/apps/img/photos/loading_spinner.gif") no repeat');
        var form_data = new FormData(file);
        form_data.append('id',item_id);
        form_data.append('table',table);

        request.onreadystatechange = function() {
            if (request.readyState == XMLHttpRequest.DONE) {
                var obj = jQuery.parseJSON(request.responseText);
                if(obj['response']['status'] == "success"){
                    var img = obj['response']['path'];
                    $('#preview').css('background-image', 'url("' + img + '")');
                }else{

                }
            }
        }
        request.open('post', '/upload/photo/', true);
        request.send(form_data);
    });


        



</script>
@stop