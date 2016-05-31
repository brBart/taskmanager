@extends('layout')

@section('breadcrumbs_title')
    Manager users
@stop


@section('css')
    <style>
    .list-thumb{
        overflow: visible!important;
    }

    .tm-user-tile{
        float: left!important;
        min-height: 250px;
        max-height: 250px;
    }

    </style>

@stop


@section('content')
     <div class="row widget-bg-color-white no-space margin-bottom-20">


        @if($mode == 'viewall' || $user == 'admin')
             <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <span class="caption-subject">Administrators</span>
                    </div>

                    <div class="caption-desc font-grey-cascade"> 
                          <a href="/invite/user" class="widget-subscribe-title primary-link">Invite User</a>
                     </div>
                </div>



                        <div v-for="admin in admins" class="col-md-3 tm-tile">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>@{{ admin.first_name }} @{{ admin.last_name }} </div>
                                    <div class="actions">
                                        <a  href="/user/admin/edit/@{{ admin.id }}" class="btn btn-default btn-sm">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        <a @click="DeleteUser(admin.id, 'admin' , $event)" href="#" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Delete </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

                                  
                                        <div class="mt-list-item">
                                                         
                                                <div class="list-thumb col-md-6">
                                                    <a href="javascript:;">
                                                        <img width="100%" src="@{{ admin.photo }}" alt="">
                                                    </a>                                    
                                                </div>
                                                <div class="list-item-content col-md-6">
                                                    <span class="mt-action-desc">@{{ admin.position }} @ @{{ admin.company_id }}</span><br>
                                                    <span class="mt-action-desc"> @{{ admin.email }}</span> <br>
                                                    <span class="mt-action-desc"> @{{ admin.phone }}</span><br>
                                                    <span class="mt-action-desc"> @{{ admin.city }}, @{{ admin.country }}</span><br>
                                                     <span class="mt-action-desc">@{{ admin.timezone }}</span><br>
                                                      <span class="mt-action-desc">Added : @{{ admin.created_at }}</span><br>

                                                </div> 
                                        </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        </div>



                 </div>
            @endif




        @if($mode == 'viewall' || $user == 'developer')    
             <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <span class="caption-subject">Developers</span>
                    </div>

                    <div class="caption-desc font-grey-cascade"> 
                          <a href="/invite/user" class="widget-subscribe-title primary-link">Invite User</a>
                     </div>
                </div>

                        <div class="col-md-3 tm-tile" v-for="developer in developers">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>@{{ developer.first_name }} @{{ developer.last_name }} </div>
                                    <div class="actions">
                                        <a href="/user/developer/edit/@{{ developer.id }}" class="btn btn-default btn-sm">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        <a @click="DeleteUser(developer.id, 'developer' , $event)" href="#" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Delete </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

                                  
                                        <div class="mt-list-item">
                                                         
                                                <div class="list-thumb col-md-6">
                                                    <a href="javascript:;">
                                                        <img width="100%" src="@{{ developer.photo }}" alt="">
                                                    </a>                                    
                                                </div>
                                                <div class="list-item-content col-md-6">
                                                    <span class="mt-action-desc">@{{ developer.position }} @ @{{ developer.company_id }}</span><br>
                                                    <span class="mt-action-desc">@{{ developer.email }}</span> <br>
                                                    <span class="mt-action-desc">@{{ developer.phone }}</span><br>
                                                    <span class="mt-action-desc">@{{ developer.city }}, @{{ developer.country }}</span><br>
                                                     <span class="mt-action-desc">@{{ developer.timezone }}</span><br>
                                                      <span class="mt-action-desc">Added :@{{ developer.created_at }}</span><br>

                                                </div> 
                                        </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        </div>


                 </div>
            @endif



        @if($mode == 'viewall' || $user == 'client')    
            <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <span class="caption-subject">Clients</span>
                    </div>

                    <div class="caption-desc font-grey-cascade"> 
                          <a href="/invite/user" class="widget-subscribe-title primary-link">Invite User</a>
                     </div>
                </div>
 


                        <div v-for="client in clients" class="col-md-3 tm-tile">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>@{{ client.first_name }} @{{ client.last_name }} </div>
                                    <div class="actions">
                                        <a href="/user/client/edit/@{{ client.id }}" class="btn btn-default btn-sm">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        <a href="#" @click="DeleteUser( client.id, 'client' , $event )" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Delete </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

                                  
                                        <div class="mt-list-item">
                                                         
                                                <div class="list-thumb col-md-6">
                                                    <a href="javascript:;">
                                                        <img width="100%" src="@{{ client.photo }}" alt="">
                                                    </a>                                    
                                                </div>
                                                <div class="list-item-content col-md-6">
                                                    <span class="mt-action-desc">@{{ client.position }} @ @{{ client.company_id }}</span><br>
                                                    <span class="mt-action-desc">@{{ client.email }}</span> <br>
                                                    <span class="mt-action-desc">@{{ client.phone }}</span><br>
                                                    <span class="mt-action-desc">@{{ client.city }}, @{{ client.country }}</span><br>
                                                     <span class="mt-action-desc">@{{ client.timezone }}</span><br>
                                                      <span class="mt-action-desc">Added :@{{ client.created_at }}</span><br>

                                                </div> 
                                        </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        </div>

                       

                 </div>
            @endif



        @if($mode == 'viewall' || $user == 'company')

            <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <span class="caption-subject">Companies</span>
                    </div>

                    <div class="caption-desc font-grey-cascade"> 
                          <a href="/company/create/0" class="widget-subscribe-title primary-link">+Add New</a>
                     </div>
                </div>

                     <div v-for="company in companies" class="col-md-3 tm-tile">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>@{{ company.name }} </div>
                                    <div class="actions">
                                        <a href="/company/edit/@{{ company.id }}" class="btn btn-default btn-sm">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        <a href="#" @click="DeleteCompany( company.id , $event )" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Delete </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

                                  
                                        <div class="mt-list-item">
                                                         
                                                <div class="list-thumb col-md-6">
                                                    <a href="javascript:;">
                                                        <img width="100%" src="@{{ company.photo }}" alt="">
                                                    </a>                                    
                                                </div>
                                                <div class="list-item-content col-md-6">
                                                    <span class="mt-action-desc">@{{ company.contact_nname }} </span><br>
                                                                <span class="mt-action-desc">@{{ company.email }}</span> <br>
                                                                <span class="mt-action-desc">@{{ company.phone }}</span><br>
                                                                <span class="mt-action-desc">@{{ company.city }}, @{{ company.country }} @{{ company.timezone }}</span><br>


                                                </div> 
                                        </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                        </div>


                        
                 </div>

            @endif
                    
    </div>

@stop



@section('javascripts')


<script>

var mixin = {

    ready : function(){
            this.FetchAdmins();
            this.FetchDevelopers();
            this.FetchClients();
            this.FetchCompanies();
    }

}
    

</script>
@stop
