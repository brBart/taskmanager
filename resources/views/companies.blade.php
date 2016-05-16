@extends('layout')

@section('breadcrumbs_title')
    Companies
@stop


@section('css')
    <style>


    .tm-tile{
        min-height: 230px;
        max-height: 230px;
    }

    </style>

@stop


@section('content')
     <div class="row widget-bg-color-white no-space margin-bottom-20">

            

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
                                        <a href="/company/delete/@{{ company.id }}" class="btn btn-default btn-sm">
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
                    
    </div>

@stop



@section('javascripts')


<script>

var mixin = {

    ready : function(){
            this.FetchCompanies();
    }

}
    

</script>
@stop
