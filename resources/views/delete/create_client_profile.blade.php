@extends('layout')

@section('breadcrumbs_title')
	Create client
@stop


@section('content')
     <div class="row widget-bg-color-white no-space margin-bottom-20">
              <form role="form">
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        	<div class="portlet-body form">
                                  
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name">
                                                <label for="form_control_1">First name</label>                
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <select class="form-control" id="form_control_1">
                                                    <option value=""></option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                                <label for="form_control_1">Company</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-success">
                                                <input type="text" class="form-control" id="form_control_1" placeholder="">
                                                <label for="form_control_1">Email</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-warning">
                                                 <select class="form-control" id="form_control_1">
                                                    <option value=""></option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                                <label for="form_control_1">City</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-error">
                                                 <select class="form-control" id="form_control_1">
                                                    <option value=""></option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                                <label for="form_control_1">Timezone</label>
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
                                                <input type="text" class="form-control" id="form_control_1" placeholder="Enter your name">
                                                <label for="form_control_1">Last name</label>                
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <select class="form-control" id="form_control_1">
                                                    <option value=""></option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                                <label for="form_control_1">Role</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-success">
                                                <input type="text" class="form-control" id="form_control_1" placeholder="">
                                                <label for="form_control_1">Phone</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-warning">
                                                 <select class="form-control" id="form_control_1">
                                                    <option value=""></option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                    <option value="4">Option 4</option>
                                                </select>
                                                <label for="form_control_1">Country</label>
                                            </div>
                                            <div class="form-group form-md-line-input has-error">
                                                 <select class="form-control" id="form_control_1">
                                                    <option value=""></option>
                                                    <option value="1">Option 1</option>
                                                    <option value="2">Option 2</option>
                                                    <option value="3">Option 3</option>
                                                    <option value="4">Option 4</option>
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