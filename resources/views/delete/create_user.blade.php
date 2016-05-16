@extends('layout')

@section('breadcrumbs_title')
    Create 

 <?php
    foreach($roles as $key => $value) {                             
        if($value == $role)
        echo '<span class="permission-title">'.$key.'</span>';
    }
?>
@stop


@section('css')
    <style>
    .tm-saving{
        position:absolute;
        top : 0px;
        right: 0px;
        display: none;
    }
    </style>
@stop


@section('content')


     <div class="row widget-bg-color-white no-space margin-bottom-20">
              <form role="form" name="users" id="users" method="post" enctype="multipart/form-data">
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                            <div class="portlet-body form">
                                  
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">

                                                <input type="text" class="form-control large-field" name="first_name" id="first_name" placeholder="Enter your name">
                                                <label for="form_control_1">First name</label> 
                                                <div class="form_control_1 tm-saving saving-first_name"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>               
                                            </div>
                                            <div class="form-group form-md-line-input second-field">
                                                <select class="form-control" name="company_id" id="company_id">
                                                    <option value=""></option>
                                                    @foreach($companies as $company)
                                                        @if($company->name != "")
                                                            <option value="{{ $company->id }}">
                                                                {{ $company->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                <label for="form_control_1">Company</label> 

                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Success state">
                                                <label for="form_control_1">Email</label>
                                                <div class="form_control_1 tm-saving saving-email"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="city" name="city">
                                                    <option value=""></option>
                                                    @foreach($cities as $city )
                                                        <option value="{{ $city }}">{{ $city }}</option>
                                                    @endforeach    
                                                </select>
                                                <label for="form_control_1">City</label>
                                                <div class="form_control_1 tm-saving saving-city"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="timezone" name="timezone">
                                                    <option value=""></option>
                                                    @foreach($timezones as $timezone )
                                                        <option value="{{ $timezone }}">{{ $timezone }}</option>
                                                    @endforeach   
                                                </select>
                                                <label for="form_control_1">Timezone</label>
                                                <div class="form_control_1 tm-saving saving-timezone"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
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
                                                <input type="text" class="form-control tm-large-field" id="last_name" name="last_name" placeholder="Enter your name">
                                                <label for="form_control_1">Last name</label>    
                                                <div class="form_control_1 tm-saving saving-last_name"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>            
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" name="position" id="position" placeholder="Success state">
                                                <label for="form_control_1">Role</label>
                                                <div class="form_control_1 tm-saving saving-position"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Success state">
                                                <label for="form_control_1">Phone</label>
                                                <div class="form_control_1 tm-saving saving-phone"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="country" name="country">
                                                    <option value=""></option>
                                                   @foreach($countries as $country )
                                                        <option value="{{ $country }}">{{ $country }}</option>
                                                    @endforeach 
                                                </select>
                                                <label for="form_control_1">Country</label>
                                                <div class="form_control_1 tm-saving saving-country"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="role_id" name="role_id">
                                                    <option value=""></option>
                                                    <?php
                                                    foreach($roles as $key => $value) {                             
                                                        $selected = "";
                                                        if($value == $role) $selected = "selected";

                                                        echo '<option value='.$value.' '.$selected.'>'.$key.'</option>';
                                                    }

                                                    ?>
                                     
                                                </select>
                                                <label for="form_control_1">Permission</label>
                                                <div class="form_control_1 tm-saving saving-role_id"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                           
                                        </div>
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
    var role = <?php echo $role; ?>;
    var table ="";

    $("input, select").focusout(function(event) {
       var field = $(this).attr('name');
       var $form = $('input[name="'+field+'"] ,select[name="'+field+'"]').closest("form");
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
                data: {'id':item_id, 'table': table, 'field' : field , 'value' : value, 'role_id':role},
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