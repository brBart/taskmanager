@extends('layout')

@section('breadcrumbs_title')
    Create Procedure
@stop


@section('css')
 
@stop



@section('content')

     <div class="row widget-bg-color-white no-space margin-bottom-20">
              <form role="form" id="procedures" name="procedures">
                    <div class="col-md-9 col-sm-6 no-space">
                        <!-- BEGIN WIDGET SUBSCRIBE -->
                        	<div class="portlet-body form">
                                  
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" v-on:blur="SaveProcedureDetail('title', procedure.title , $event )" v-model="procedure.title" class="form-control" id="title" name="title" placeholder="Enter your name">
                                            <label for="form_control_1">Procedure</label>       
                                            <div class="form_control_1 tm-saving saving-title"></div>          
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <textarea v-model="procedure.description" class="form-control" v-on:blur="SaveProcedureDetail('description', procedure.description , $event )" id="description" name="description" rows="20"></textarea>
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
                                <div class="input-group">
                                    <div class="icheck-list icheckbox_minimal-grey checked">
                                        
                                        
                                            <label v-for="skill in skills">
                                                <input type="checkbox" class="icheck skill-procedure" data-checkbox="icheckbox_square-grey" id="skill_id_@{{ skill.id }}" name="skill_id_@{{ skill.id }}" @click="SaveSkillProcedure(procedure.id,  skill.id,$event)"> @{{ skill.name }}
                                            </label>
                                            <div class="form_control_1 tm-saving saving-@{{ procedure.id }}"><img width="45" src="/assets/apps/img/tm-saving.gif"></div> 
                                        
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
    menubar: false,
    setup : function (ed) {
        ed.onInit.add(function (ed) {

            /* onBlur */
            tinymce.dom.Event.add(ed.getBody(), 'blur', function (e) {
                vm.SaveProcedureDescription('description',tinymce.activeEditor.getContent());  
            });

            /* onFocus */
           /* tinymce.dom.Event.add(ed.getBody(), 'focus', function (e) {
                console.log('Editor with ID "' + ed.id + '" has focus.');   
            });*/
        });
    }
});

var mixin = {

    ready : function(){
            this.FetchSkills();
    }

}
    

</script>
@stop
