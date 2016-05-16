@extends('layout')

@section('breadcrumbs_title')
    Create skill
@stop


@section('content')

     <div class="row widget-bg-color-white no-space margin-bottom-20">
              <form role="form" id="skills" name="skills">
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        	<div class="portlet-body form">
                                  
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                            <label for="form_control_1">Skill name</label>                
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                            <label for="form_control_1">Descrption</label>
                                        </div>   
                            
                                    </div>
                          
                                        
                            </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        <div class="portlet-body form">
                                  
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <select class="form-control" id="user_id" name="user_id">
                                                    <option value="" selected></option>
                                                     @foreach ($users as $user)
                                                        <option value="{{ $user->id}}">{{ $user->first_name }} {{ $user->last_name}}</option>
                                                     @endforeach    
                                                </select>
                                                <label for="form_control_1">Skill leader</label>
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
                       	     <div id="preview" style="background: url(/assets/apps/img/photos/preview.png) no-repeat" class="widget-gradient margin-top-20">
                        </div>

                        <input name="photo" type="file" id="photo" name="photo" />
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                </form>
                    
                </div>

@stop




@section('javascripts')



<script>


    var item_id = 0; 
    var table = '';

    $("textarea, input, select").focusout(function(event) {
       var field = $(this).attr('name');
       var $form = $('input[name="'+field+'"] ,select[name="'+field+'"] ,textarea[name="'+field+'"]').closest("form");
       table = $form.attr('name');
       var value = $('#'+field).val();


       if((typeof value !== 'undefined') && ( value.length >= 1)){
            var url = "/save/data";
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $(".saving-"+field).css('display','block'); 
            $.ajax({
                type: "POST",
                url: url,
                data: {'id':item_id, 'table': table, 'field' : field , 'value' : value},
                cache: false,
                success: function(data){
                    if(data["response"]["status"] == 'success'){
                        item_id = data["response"]["id"];
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
        
    });


    var file = document.querySelector("form");
    var request = new XMLHttpRequest();

    $('#photo').change(function(){
        $('#preview').css('background-image', 'url("/assets/apps/img/photos/loading_spinner.gif")');
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