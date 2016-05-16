@extends('layout')

@section('breadcrumbs_title')
@stop


@section('content')

     <div class="row widget-bg-color-white no-space margin-bottom-20">
              <form role="form" id="skills" name="skills">
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        	<div class="portlet-body form">
                                  
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input v-on:blur="SaveSkillDetail('name', skill.name , $event )" type="text" class="form-control" v-model="@{{ skill.name }}" id="name" name="name" placeholder="Enter your name">
                                            <label for="form_control_1">Skill name</label>  

                                            <div class="form_control_1 tm-saving saving-name"></div>                   
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <textarea class="form-control" id="description" v-model="@{{ skill.description }}" name="description" rows="3" v-on:blur="SaveSkillDetail('description', skill.description , $event )"></textarea>
                                            <label for="form_control_1">Descrption</label>
                                            <div class="form_control_1 tm-saving saving-description"></div> 
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
                                                <select v-on:blur="SaveSkillDetail('user_id', skill.user_id , $event )" v-model="skill.user_id" class="form-control" id="user_id" name="user_id">
                                                    <option v-for="developer in developers" v-bind:value="developer.id">
                                                        @{{ developer.first_name }} @{{ developer.last_name }}
                                                    </option>  
                                                </select>
                                                <label for="form_control_1">Skill leader</label>
                                                
                                            <div class="form_control_1 tm-saving saving-user_id"></div>
                                            </div>
                                           
                                        </div>
                                   
                                </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                       	     <div id="preview" style="background: url(/assets/apps/img/photos/preview.png) no-repeat" class="widget-gradient margin-top-20">
                        </div>

                        <input @change="UploadPhoto(skill.id ,'skill', 'skills',$event)" name="photo" type="file" id="photo"/>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                </form>
                    
                </div>


@stop




@section('javascripts')

<script>

var mixin = {
    ready : function(){
        this.FetchSkills();
        this.FetchDevelopers();
    }
}
    
</script>
@stop