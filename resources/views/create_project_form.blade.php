@extends('layout')

@section('breadcrumbs_title')
    Create project
@stop


@section('content')

     <div class="row widget-bg-color-white no-space margin-bottom-20">
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        	<div class="portlet-body form">
                                  
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="hidden" v-model="project.id">
                                            <input v-on:blur="SaveProjectDetail('project_name', project.project_name , $event )" type="text" v-model="project.project_name" class="form-control" id="project_name" name="project_name" placeholder="Enter your name">
                                            <label for="form_control_1">Project name</label>  

                                            <div class="form_control_1 tm-saving saving-project_name"></div>                        
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <input v-on:blur="SaveProjectDetail('email', project.email , $event )" type="text" class="form-control" v-model="project.email" id="email" name="email" placeholder="Enter your name">
                                            <label for="form_control_1">Contact email</label>     

                                            <div class="form_control_1 tm-saving saving-email"></div>            
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
                                                <input type="text"  v-on:blur="SaveProjectDetail('contact_name', project.contact_name , $event )"  class="form-control"  v-model="project.contact_name" id="contact_name" name="contact_name" placeholder="Enter your name">
                                                <label for="form_control_1">Contact name</label>        

                                                <div class="form_control_1 tm-saving saving-contact_name"></div>               
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input type="text" class="form-control" v-on:blur="SaveProjectDetail('phone', project.phone , $event )" v-model="project.phone"  id="phone" name="phone" placeholder="Enter your name">
                                                <label for="form_control_1">Contact phone</label>     

                                                <div class="form_control_1 tm-saving saving-phone"></div>              
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
                                    <input @change="UploadPhoto(project.id ,'project', 'projects',$event)" name="photo" type="file" id="photo" name="photo" />
                                
                                </div>
                            </div>
                        </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>

                     <div class="col-md-3 col-sm-3 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->

                        <div class="portlet-body form ">
                            <button v-show="project.id > 0" class="btn btn-primary" v-on:click="AddNewCredential()" type="button">New</button >                            
                        </div>

                        <!--- Credential listing--> 
                        <div class="portlet-body form" v-for="credential in credentials">
                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <span class="col-md-6 col-sm-6 no-space">
                                        Title : @{{ credential.title }} 
                                    </span>

                                    <span class="col-md-6 col-sm-6 no-space">
                                        URL : @{{ credential.url }}
                                    </span > 

                                    <span class="col-md-6 col-sm-6 no-space">
                                        Username : @{{ credential.username }} 
                                    </span>

                                    <span class="col-md-6 col-sm-6 no-space">
                                        Password : @{{ credential.password }}  
                                    </span>

                                    <span class="col-md-12 col-sm-12 no-space">
                                        Notes : @{{ credential.notes }}  
                                    </span>

                                     <span class="col-md-12 col-sm-12 no-space">
                                       <a v-on:click="EditCredential(credential.id)" href="#">edit</a> | <a v-on:click="DeleteCredential(credential.id ,$event)" href="#">delete</a>
                                    </span>
                    
                    
                                </div>
                            </div>
                        </div>
                        <!--- End credential listing--> 

                         <div class="portlet-body form" v-show="newEditCredential">
                            <div class="form-body">
                                <form  @submit.prevent="SaveCredential($event)">
                                    {!! csrf_field() !!}
                                    <input type="hidden" class="form-control"  v-model="newCredential.id" >

                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control"  v-model="newCredential.title" placeholder="Title">
                                        <label for="form_control_1">Title</label>     
                                        <div class="form_control_1 tm-saving saving-title"></div>               
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control"  v-model="newCredential.url" placeholder="URL">
                                        <label for="form_control_1">URL</label>     
                                        <div class="form_control_1 tm-saving saving-url"></div>               
                                    </div>  

                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control"  v-model="newCredential.username" placeholder="Enter  username">
                                        <label for="form_control_1">username</label>     
                                        <div class="form_control_1 tm-saving saving-username"></div>               
                                    </div>  

                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control"  v-model="newCredential.password" placeholder="Enter password">
                                        <label for="form_control_1">password</label>     
                                        <div class="form_control_1 tm-saving saving-password"></div>               
                                    </div>  


                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control"  v-model="newCredential.notes" placeholder="Enter notes">
                                        <label for="form_control_1">Notes</label>     
                                        <div class="form_control_1 tm-saving saving-notes"></div>               
                                    </div>  

                                    <button class="btn btn-primary"  type="submit">Save</button>  
                                    <button class="btn btn-primary" v-on:click="CancelNewCredential()"  type="button">Cancel</button >  
                                </form>
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

                                    <div class="form_control_1 tm-saving saving-@{{ project.id }}"></div>      
                                    <div class="icheck-inline">
                                            
                                            <div v-for="company in companies" style="float: left;">                                      
                                                <label>
                                                <input type="checkbox" id="company_id_@{{ company.id }}" @click="SaveProjectManager(project.id,  company.id, 0,$event)"  name="company_id_@{{ company.id }}" class="project-manager company icheck"> @{{ company.name}} </label>
                                            </div>
                                            

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

                                <div class="form_control_1 tm-saving saving-@{{ project.id }}"></div>      
                                <div class="input-group">
                                    <div class="icheck-inline">
                                            <div class="row">
                                            <div>Admin</div>
                                            <div v-for="admin in admins" style="float: left;">
                                                <label>
                                                <input type="checkbox" @click="SaveProjectManager(project.id,  0, admin.id,$event)" id="user_id_@{{ admin.id }}" name="user_id_@{{ admin.id }}" class="project-manager user icheck"> @{{ admin.first_name}} @{{ admin.last_name}} </label>
                                            </div>
                                            </div>

                                            <div class="row">
                                                <div>Clients</div>
                                                <div v-for="client in clients" style="float: left;">
                                                    <label>
                                                    <input type="checkbox" @click="SaveProjectManager(project.id,  0, client.id,$event)" id="user_id_@{{ client.id }}" name="user_id_@{{ client.id }}" class="project-manager user icheck"> @{{ client.first_name}} @{{ client.last_name}} </label>
                                                </div>
                                            <div>

                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
        </div> 




                     
    </div>

@stop



@section('javascripts')



<script>

var mixin = {
    data: function(){
            return {    
                        

                        project : {        
                            id : 0,
                        },

                        newCredential :{
                            id : '',
                            title : '',
                            url : '',
                            username : '',
                            password : '',
                            notes : '',
                            project_id : 0,
                        },
            }
    },

    ready : function(){
            this.FetchCompanies();
            this.FetchClients();
            this.FetchAdmins();
    }

}
    



</script>
@stop