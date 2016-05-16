@extends('layout')

@section('breadcrumbs_title')
    Tasks
@stop


@section('css')
    <style>

    </style>
@stop


@section('content')
 
<div id="main" class="row pad-10px tm-tasks-main-container">
	<div class="row m-heading-1 border-green m-bordered" >
		<div class="row">
			<form @submit.prevent="QueryTimespent()">
				<div class="form-body">
					<div class="form-group desk-3-12 pad-r-10px">
		                <div class="col-md-3">
		                    <input v-model="queryTimeSpent.startDate" placeholder="Start" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" />
		                </div>
		            </div>

		            <div class="form-group desk-3-12 pad-r-10px">
		                <div class="col-md-3">
		                    <input placeholder="End" v-model="queryTimeSpent.endDate" class="form-control form-control-inline input-medium date-picker" size="16" type="text" value="" />
		                </div>
		            </div>

		            <div class="form-group desk-3-12 pad-r-10px">
	                    <select v-model="queryTimeSpent.companyId" class="form-control" name="company_id" id="company_id">
	                    	<option v-bind:value="0">
	                            All
	                        </option>
	                        <option v-for="company in companies" v-bind:value="company.id">
	                            @{{ company.name }}
	                        </option>
	                    </select>
	                </div>

	                <div class="form-actions desk-3-12  pad-r-10px">
						<button class="btn blue" type="submit">Submit</button>
					</div>

	            </div>

			</form>
		</div>
		<div class="row">

			<span class=" desk-2-12  pad-10px"> <a v-on:click="SortReportBy('user')" href="#">by user </a></span>
			<span class=" desk-2-12  pad-10px"> <a v-on:click="SortReportBy('project')" href="#">by project </a></span>
			<span class=" desk-2-12  pad-10px"> <a v-on:click="SortReportBy('date')" href="#">by date </a></span>

		</div>

		<div class="row-fluid sort-by-user" style="min-height:300px;" v-show="userFormat">
			<div v-for="tsr in timeSpentReport">
				<p> @{{ tsr.name }}</p>

				<div v-for="timespentdetail in tsr.time_spent">
					@{{ timespentdetail.date }} | @{{ timespentdetail.project_title }} | @{{ timespentdetail.task_title }} | @{{ timespentdetail.start_datetime }} - @{{ timespentdetail.end_datetime }} = @{{ timespentdetail.spent }}  
				</div>

				<div style="float:right;">
					Total : @{{ tsr.user_time_spent }}
				</div>

			</div>
		</div>


		<div class="row-fluid sort-by-user" style="min-height:300px;" v-show="projectFormat">
			<div v-for="tsr in timeSpentReport">
				<p> @{{ tsr.project_name }}</p>

				<div v-for="timespentdetail in tsr.time_spent">
					@{{ timespentdetail.date }} | @{{ timespentdetail.task_title }} |  @{{ timespentdetail.user }}  | @{{ timespentdetail.start_datetime }} - @{{ timespentdetail.end_datetime }} = @{{ timespentdetail.spent }}  
				</div>

				<div style="float:right;">
					Total : @{{ tsr.user_time_spent }}
				</div>

			</div>
		</div>


		<div class="row-fluid sort-by-user" style="min-height:300px;" v-show="dateFormat">
			<div v-for="tsr in timeSpentReport">
				<p> @{{ tsr.date }}</p>

				<div v-for="timespentdetail in tsr.time_spent">
					 @{{ timespentdetail.project_title }} | @{{ timespentdetail.task_title }} |  @{{ timespentdetail.user }}  | @{{ timespentdetail.start_datetime }} - @{{ timespentdetail.end_datetime }} = @{{ timespentdetail.spent }}  
				</div>

				<div style="float:right;">
					Total : @{{ tsr.user_time_spent }}
				</div>

			</div>
		</div>





	</div>
</div>

@stop	


@section('javascripts')
<script>
var mixin = {
	data : function(){
				return {
	
				}
	},

    ready : function(){
    	this.FetchCompanies();
    }
}
</script>
@stop																																																																																																																											