@extends('layout')

@section('breadcrumbs_title')
    Clients
@stop


@section('css')
    <style>
    .list-thumb{
        overflow: visible!important;
    }


    .mt-list-container ul li{
        float :left;
    }

    .user-tile{
        float: left!important;
    }

    </style>

@stop




@section('content')
     <div class="row widget-bg-color-white no-space margin-bottom-20">

         <?php 


echo THUMBS_DIR_PATH;

?>


             <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <span class="caption-subject">Clients</span>
                    </div>

                    <div class="caption-desc font-grey-cascade"> 
                          <a href="/user/client/create" class="widget-subscribe-title primary-link">+Add New</a>
                     </div>
                </div>
                     @foreach ($users as $user)
                        @if($user->role_id == $role)
                         <div class="col-lg-3 user-tile">
                            <!-- BEGIN WIDGET SUBSCRIBE -->
                            <div class="portlet light portlet-fit">
                                <div class="portlet-title">
                                    
                                </div>

                                <div class="portlet-body">
                                   
                                                                            
                                            <!-- Start User Details-->
                                            <div class="mt-element-list">
                                                               
                                                <div class="mt-list-container list-news ext-1">
                                                    <ul>
                                                        <li class="mt-list-item">
                                                         
                                                            <div class="list-thumb">
                                                                <a href="javascript:;">
                                                                    <img src="{{ $user->photo }}" alt="">
                                                                </a>                                    
                                                                <div>
                                                                    <span>
                                                                        <a href="#" class="">Edit</a>
                                                                    </span>
                                                                    <span>
                                                                        <a href="#" class="">Delete</a>
                                                                    </span>
                                                                 
                                                                </div>
                                                            </div>
                                                            <div class="list-item-content">
                                                                <h3 class="uppercase">
                                                                    <a href="javascript:;">{{ $user->first_name }} {{ $user->last_name }}</a>
                                                                </h3>
                                                                <span class="mt-action-desc">{{ $user->position }} @ {{ $user->company_id }}</span><br>
                                                                <span class="mt-action-desc">{{ $user->email }}</span> <br>
                                                                <span class="mt-action-desc">{{ $user->phone }}</span><br>
                                                                <span class="mt-action-desc">{{ $user->city }}, {{ $user->country }}{{ $user->timezone }}</span><br>

                                                            </div>

                                                            <div class="list-datetime">  Added :8 Nov, 2015 </div>
                                                        </li>
                                                       
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- End User Details-->
                                           
                    
                                </div>
                            </div>          
                            <!-- END WIDGET SUBSCRIBE -->
                        </div>
                        @endif
                    @endforeach
                 </div>

         
                    
    </div>

@stop