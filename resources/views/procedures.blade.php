@extends('layout')

@section('breadcrumbs_title')
    Procedures
@stop


@section('css')
    <style>
    .tm-tile{
    }
    </style>

@stop


@section('content')
     <div class="row widget-bg-color-white no-space margin-bottom-20">


            <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <span class="caption-subject">Procedures</span>
                    </div>

                    <div class="caption-desc font-grey-cascade"> 
                          <a href="/procedure/create/0" class="widget-subscribe-title primary-link">+Add New</a>
                     </div>
                </div>

                        <div v-for="procedure in procedures"class="col-md-3 tm-tile">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>@{{ procedure.title | str_limit  }} </div>
                                    <div class="actions">
                                        <a href="/procedure/edit/@{{ procedure.id }}" class="btn btn-default btn-sm">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        <a href="/procedure/delete/@{{ procedure.id}} " class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Delete </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

                                        <span class="mt-action-desc">@{{ procedure.description | strip_tags 250 }} </span>

                                     </div>

                                        <div class="list-datetime">  Added :@{{ procedure.created_at }} </div>

                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>            
                        <!-- end -->

                 </div>
                    
    </div>

@stop



@section('javascripts')
<script>
    var mixin = {

        ready : function(){
                this.FetchProcedures();
        }

    }
</script> 
@stop