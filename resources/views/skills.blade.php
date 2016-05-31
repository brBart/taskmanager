@extends('layout')

@section('breadcrumbs_title')
    Team Skills
@stop


@section('css')
    <style>

    .tm-tile{
    
    }

    .tm-content{
        width: 30%;
        float: right;
    }

    </style>

@stop


@section('content')
     <div class="row widget-bg-color-white no-space margin-bottom-20">


            <div class="row">
                <div class="col-lg-12">
                    <div class="caption">
                        <span class="caption-subject">Skills</span>
                    </div>

                    <div class="caption-desc font-grey-cascade"> 
                          <a href="/skill/create/0" class="widget-subscribe-title primary-link">+Add New</a>
                     </div>
                </div>


                        <div class="col-md-3 tm-tile" v-for="skill in skills">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet box blue-hoki">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>@{{ skill.name }} </div>
                                    <div class="actions">
                                        <a href="/skill/edit/@{{ skill.id }}" class="btn btn-default btn-sm">
                                            <i class="fa fa-pencil"></i> Edit </a>
                                        <a @click="DeleteSkill(skill.id , $event)" class="btn btn-default btn-sm">
                                            <i class="fa fa-plus"></i> Delete </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="scroller" style="height:200px" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

                                  
                                        <div class="mt-list-item">
                                                         
                                                <div class="list-thumb col-md-6">
                                                    <a href="javascript:;">
                                                        <img width="100%" src="@{{ skill.photo | check_photo }}" alt="">
                                                    </a>                                    
                                                </div>
                                                <div class="list-item-content col-md-6">
                                                    <h3 class="uppercase">
                                                        <a href="javascript:;">@{{ skill.name }}</a>
                                                    </h3>
                                                    <span class="mt-action-desc">@{{ skill.description }} </span><br>

                                                     <div class="list-datetime">  Added : @{{ $skill.created_at }}</div>
                                                    
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
<!--
<script src="/js/skill.js"></script> -->
<script>
    var mixin = {

        ready : function(){
                this.FetchSkills();
        }

    }
</script> 
@stop