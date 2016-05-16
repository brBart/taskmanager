@extends('layout')

@section('breadcrumbs_title')
	Create admin 
@stop

@section('content')
     <div class="row widget-bg-color-white no-space margin-bottom-20">
              <form role="form" name="users" id="users">
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        	<div class="portlet-body form">
                                  
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control large-field" name="first_name" id="first_name" placeholder="Enter your name">
                                                <label for="form_control_1">First name</label>                
                                            </div>
                                            <div class="form-group form-md-line-input second-field">
                                                <select class="form-control" name="company_id" id="company_id">
                                                    <option value=""></option>
                                                    <option value="1">Company 1</option>
                                                    <option value="2">Company 2</option>
                                                    <option value="3">Company 3</option>
                                                    <option value="4">Company 4</option>
                                                </select>
                                                <label for="form_control_1">Company</label>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Success state">
                                                <label for="form_control_1">Email</label>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="city" name="city">
                                                    <option value=""></option>
                                                    <option value="Davao City">Davao City</option>
                                                    <option value="Manila">Manila</option>
                                                    <option value="Cebu City">Cebu City</option>
                                                    <option value="Cagayan de oro City">Cagayan de oro City</option>
                                                </select>
                                                <label for="form_control_1">City</label>
                                            </div>




                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="timezone" name="timezone">
                                                    <option value=""></option>
                                                    <option value="America/New_York">America/New_York</option>
                                                    <option value="America/Chicago">+America/Chicago</option>
                                                    <option value="America/Denver">America/Denver</option>
                                                    <option value="America/Los_Angeles">America/Los_Angeles</option>
                                                    <option value="Philippines/Manila">Philippines/Manila</option>
                                                </select>
                                                <label for="form_control_1">Timezone</label>
                                            </div>
                                           
                                        </div>
                                        <!--<div class="form-actions noborder">
                                            <button type="button" class="btn blue">Submit</button>
                                            <button type="button" class="btn default">Cancel</button>
                                        </div>-->

                                        <p class="result-message">Message here</p>
                                   
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
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" name="position" id="position" placeholder="Success state">
                                                <label for="form_control_1">Role</label>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Success state">
                                                <label for="form_control_1">Phone</label>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="country" name="country">
                                                    <option value=""></option>
                                                    <option value="Phil">Phil</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="USA">USA</option>
                                                </select>
                                                <label for="form_control_1">Country</label>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select class="form-control" id="role_id" name="role_id">
                                                    <option value=""></option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role[0] }}">{{ $role[1]}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="form_control_1">Permission</label>
                                            </div>
                                           
                                        </div>
                       				</div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                       	<div style="background: url(/assets/layouts/layout7/img/01.jpg)" class="widget-gradient margin-top-20">
                        </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                </form>

                
                    
                </div>


@stop


@section('javascripts')



<script>

	$(document).ready(function(){
	$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

	});

	var item_id = 0; 

	$("input, select").focusout(function(event) {
       var field = $(this).attr('name');
       var $form = $('input[name="'+field+'"] ,select[name="'+field+'"]').closest("form");

       var table = $form.attr('name');
       console.log('table->'+table);
       var value = $('#'+field).val();
       console.log('table->'+table+' field-->'+field+' value->'+value);



       if((typeof value !== 'undefined') && ( value.length >= 1)){
	        var url = "http://localhost:8000/save/data";
	     	$.ajaxSetup({
			  headers: {
			    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			  }
			});
            $.ajax({
	            type: "POST",
	            url: url,
	            data: {'id':item_id, 'table': table, 'field' : field , 'value' : value},
	            cache: false,
	            success: function(data){
                     console.log('item_id '.item_id);
	            	if(data["response"]["status"] == 'success'){
                        item_id = data["response"]["id"];
                        console.log('item_id '.item_id);
	            		$('#'+table+' .result-message').html(' saved....');
                    }else{
                        console.log("error inside");
	            		$('#'+table+' .result-message').html(' failed....');
                    }
	               return data;
	            }
            }).error(function(data){
                console.log('item_id erro '.item_id);
            	$('#'+table+' .result-message').html(' failed....');
            });
        }else{
            console.log("not def-->"+value);
        }
        
    });
        



</script>
@stop