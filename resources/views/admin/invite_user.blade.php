@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Invite user</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" @submit.prevent="SendEmail()" method="GET">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input v-model="invite.email" v-on:blur="CheckEmailIfUsed()" type="email" class="form-control" name="email" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Permission type</label>

                            <div class="col-md-6">
                                
                                 <select v-model="invite.role_id" class="form-control" id="role_id" name="role_id">
                                        <option selected></option>
                                        <option v-for="(index, item) in roles" v-bind:value="item" value="@{{ item }}" >
                                            @{{ index }}
                                        </option>
                                </select>

                            </div>
                        </div>

                 

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Invitation
                                </button>

                            </div>
                        </div>
                    </form>

                      <ul class="errors">
                        <li v-show="!validation.email">Please provide a valid email address.</li>
                        <li v-show="!validation.role_id">Please select role.</li>
                        <li v-show="!validation.emailExist">This email is already in use, would you like reset the password? click <a href="#">here</a>.</li>
                        

                      </ul>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<pre>
    @{{ invite | json }}    

</pre> -->
@endsection



@section('javascripts')

<!--<script src="/js/admin.js"></script>-->
<script>

var mixin = {

    ready : function(){
            this.FetchRoles();
    }

}
    

</script>
@stop
