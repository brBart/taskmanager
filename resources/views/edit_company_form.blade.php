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

                                                <input type="text" v-on:blur="SaveCompanyDetail('name', company.name , $event )" v-model="company.name" class="form-control large-field" name="name" id="name" placeholder="Enter Company name">
                                                <label for="form_control_1">Name</label> 
                                                <div class="form_control_1 tm-saving saving-name"></div>               
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <input v-on:blur="SaveCompanyDetail('email', company.email , $event )" v-model="company.email" type="text" class="form-control" id="email" name="email" placeholder="">
                                                <label for="form_control_1">Email</label>
                                                <div class="form_control_1 tm-saving saving-email"></div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                 <select v-on:blur="SaveCompanyDetail('city', company.city, $event )" v-model="company.city" class="form-control" id="city" name="city">
                                                    <option v-for="city in cities" v-bind:value="city">
                                                        @{{ city }}
                                                    </option>
                                                </select>
                                                <label for="form_control_1">City</label>
                                                <div class="form_control_1 tm-saving saving-city"></div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                 <select v-on:blur="SaveCompanyDetail('timezone', company.timezone , $event )" v-model="company.timezone" class="form-control" id="timezone" name="timezone">

                                                    <option v-for="(index, item) in timezones" v-bind:value="item" >
                                                        @{{ index }}
                                                    </option>

                                                </select>
                                                <label for="form_control_1">Timezone</label>
                                                <div class="form_control_1 tm-saving saving-timezone"></div>
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
                                                <input v-on:blur="SaveCompanyDetail('contact_name', company.contact_name , $event )" type="text" class="form-control tm-large-field" id="contact_name" v-model="company.contact_name" name="contact_name" v-model="company.contact_name" placeholder="Enter your name">
                                                <label for="form_control_1">Contact name</label>    
                                                <div class="form_control_1 tm-saving saving-contact_name"></div>            
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                <input v-on:blur="SaveCompanyDetail('phone' , company.phone , $event )" type="text" class="form-control" id="phone" name="phone" v-model="company.phone" placeholder="">
                                                <label for="form_control_1">Phone</label>
                                                <div class="form_control_1 tm-saving saving-phone"></div>
                                            </div>

                                            <div class="form-group form-md-line-input">
                                                 <select v-on:blur="SaveCompanyDetail('country' , company.country , $event )" v-model="company.country" class="form-control" id="country" name="country">
                                                    <option v-for="country in countries" v-bind:value="country">
                                                        @{{ country }}
                                                    </option>
                                                </select>
                                                <label for="form_control_1">Country</label>
                                                <div class="form_control_1 tm-saving saving-country"></div>
                                            </div>

                                           
                                        </div>
                                    </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        <div id="preview" style="background: url({!! $company->get_photo() !!}) no-repeat" class="widget-gradient margin-top-20">
                        </div>

                        <input @change="UploadPhoto(company.id ,'company', 'companies',$event)" name="photo" type="file" id="photo" name="photo" />
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
                        company :{
                                    id : '{!! $company->id !!}',
                                    name : '{!! $company->name !!}',
                                    contact_name : '{!! $company->contact_name !!}',
                                    phone : '{!! $company->phone !!}',
                                    city : '{!! $company->city !!}',
                                    email : '{!! $company->email !!}',
                                    country : '{!! $company->country !!}',
                                    timezone : '{!! $company->timezone !!}',
                               }


                    }
           },

    ready : function(){
        this.FetchCities();
        this.FetchTimezones();
        this.FetchCountries();
    }

}

</script>
@stop