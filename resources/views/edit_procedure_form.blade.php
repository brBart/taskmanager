@extends('layout')

@section('breadcrumbs_title')
    Edit 
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
              <form role="form" id="procedures" name="procedures">
                    <div class="col-md-9 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                            <div class="portlet-body form">
                                  
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" v-on:blur="SaveProcedureDetail('title', procedure.title , $event )" class="form-control" id="title" v-model="procedure.title" name="title" placeholder="Enter your name">
                                            <label for="form_control_1">Procedure</label>     
                                            <div class="form_control_1 tm-saving saving-title"></div>                   
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <textarea v-model="procedure.description" class="form-control" v-on:blur="SaveProcedureDetail('description', procedure.description , $event )" id="description" name="description" rows="20">{{ $procedure->description }}</textarea>
                                            <label for="form_control_1">Descrption</label>
                                            <div class="form_control_1 tm-saving saving-description"></div>
                                        </div>   
                            
                                    </div>
                          
                                        
                            </div>
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
  
                    <div class="col-md-3 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                         <div class="form-group">
                                <label>Related skills</label>
                                <div class="form_control_1 tm-saving saving-@{{ procedure.id }}"></div>
                                <div class="input-group">
                                    <div class="icheck-list icheckbox_minimal-grey checked">
                                        
                                        
                                            <label v-for="skill in skillProcedures">
                                                <input type="checkbox" class="icheck skill-procedure" data-checkbox="icheckbox_square-grey" @click="SaveSkillProcedure(procedure.id,  skill.id,$event)" id="skill_id_@{{ skill.id }}" name="skill_id_@{{ skill.id }}" v-model="skill.selected" value="@{{ skill.id }}"> @{{ skill.name }}
                                            </label>

                                            
                                        
                                    </div>
                                </div>
                            </div>
                            
                        <!-- END WIDGET SUBSCRIBE -->
                    </div>
                </form>
                    
    </div>




@stop



@section('javascripts')
<script>

tinymce.init({
    selector: "textarea",
    setup: function(editor) {
        editor.on('blur', function(e) {
          vm.SaveProcedureDescription('description', tinyMCE.activeEditor.getContent() );
        });
    }
});


var mixin = {

    data: function(){
        
            return {    
                        procedure :{
                                    id : '{!! $procedure->id !!}',
                                    title : '{!! $procedure->title !!}',
                                   }


                    }
           },

    ready : function(){
            this.FetchSkills();
            this.FechSkillProcedure();
    }

}
    



</script>
@stop