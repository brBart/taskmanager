@extends('layout')

@section('breadcrumbs_title')
    Create 


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

                                                <input type="text" v-on:blur="SaveUserDetail('first_name', user.first_name , $event )" v-model="user.first_name" class="form-control large-field" name="first_name" id="first_name" placeholder="Enter your name">
                                                <label for="form_control_1">First name</label> 
                                                <div class="form_control_1 tm-saving saving-first_name"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>               
                                            </div>
                                            <div class="form-group form-md-line-input second-field">
                                                <select v-on:blur="SaveUserDetail('company_id', user.company_id , $event )" v-model="user.company_id" class="form-control" name="company_id" id="company_id">
                                                    <option v-for="company in companies" v-bind:value="company.id">
                                                        @{{ company.name }}
                                                    </option>
                                                </select>
                                                <label for="form_control_1">Company</label> 

                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input v-on:blur="SaveUserDetail('email', user.email , $event )" v-model="user.email" type="text" class="form-control" id="email" name="email" >
                                                <label for="form_control_1">Email</label>
                                                <div class="form_control_1 tm-saving saving-email"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select v-on:blur="SaveUserDetail('city', user.city, $event )" v-model="user.city" class="form-control" id="city" name="city">
                                                    <option v-for="city in cities" v-bind:value="city">
                                                        @{{ city }}
                                                    </option>
                                                </select>
                                                <label for="form_control_1">City</label>
                                                <div class="form_control_1 tm-saving saving-city"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                 <select v-on:blur="SaveUserDetail('timezone', user.timezone , $event )" v-model="user.timezone" class="form-control" id="timezone" name="timezone">
                                                    <option v-for="(index, timezone) in timezones" v-bind:value="timezone" value="@{{ timezone }}">
                                                        @{{ index }}
                                                    </option>
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
                                                <input v-on:blur="SaveUserDetail('last_name', user.last_name , $event )" type="text" class="form-control tm-large-field" id="last_name" v-model="user.last_name" name="last_name" placeholder="Enter your name">
                                                <label for="form_control_1">Last name</label>    
                                                <div class="form_control_1 tm-saving saving-last_name"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>            
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input v-on:blur="SaveUserDetail('position', user.position, $event )" type="text" class="form-control" name="position" id="position" v-model="user.position" >
                                                <label for="form_control_1">Role</label>
                                                <div class="form_control_1 tm-saving saving-position"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <input v-on:blur="SaveUserDetail('phone' , user.phone , $event )" type="text" class="form-control" id="phone" name="phone" v-model="user.phone" >
                                                <label for="form_control_1">Phone</label>
                                                <div class="form_control_1 tm-saving saving-phone"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select v-on:blur="SaveUserDetail('country' , user.country , $event )" v-model="user.country" class="form-control" id="country" name="country">
                                                    <option v-for="country in countries" v-bind:value="country">
                                                        @{{ country }}
                                                    </option>
                                                </select>
                                                <label for="form_control_1">Country</label>
                                                <div class="form_control_1 tm-saving saving-country"><img width="45" src="/assets/apps/img/tm-saving.gif"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select v-on:blur="SaveUserDetail('role_id', user.role_id , $event )" v-model="user.role_id" class="form-control" id="role_id" name="role_id">
                                                    <option v-for="(index, item) in roles" v-bind:value="item" >
                                                        @{{ index }}
                                                    </option>
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
                        <div id="preview" style="background: url({!! $user->get_photo() !!}) no-repeat" class="widget-gradient margin-top-20">
                        </div>

                        <input @change="UploadPhoto(user.id ,'user', 'users',$event)" name="photo" type="file" id="photo" name="photo" />
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                </form>

                
                    
                </div>


@stop


@section('javascripts')


<script>

var mixin = {

    data: function(){
        
            return {    
                        user :{
                                    id : '{!! $user->id !!}',
                                    first_name : '{!! $user->first_name !!}',
                                    last_name : '{!! $user->last_name !!}',
                                    company_id : '{!! $user->company_id !!}',
                                    position : '{!! $user->position !!}',
                                    phone : '{!! $user->phone !!}',
                                    city : '{!! $user->city !!}',
                                    email : '{!! $user->email !!}',
                                    country : '{!! $user->country !!}',
                                    timezone : '{!! $user->timezone !!}',
                                    role_id : '{!! $user->role_id !!}',
                                    photo : '{!! $user->get_photo() !!}',
                               }


                    }
           },

    ready : function(){
        this.FetchCompanies();
        this.FetchCities();
        this.FetchTimezones();
        this.FetchCountries();
        this.FetchRoles();
    }

}





</script>
@stop