<template>
	<div class="row">
		<div class="col-md-4">
		<Cards path="/administrator/campuses" title="Total Campuses" content="click here" icon="mdi-town-hall"/>
		<Cards path="/administrator/students" title="Total Students" content="click here" icon="mdi-account-school-outline" />
		<Cards path="/administrator/faculty" title="Total Faculty" content="click here" icon="mdi-card-account-details-outline" />
		<Cards path="/administrator/faculty" title="Active Evaluator" content="click here" icon="mdi-account-multiple-check-outline" />
		<Cards path="/administrator/faculty" title="Not Active Evaluator" content="click here" icon="mdi-account-multiple-remove-outline" />
		</div>
		<div class="col-md-8">
			<BarChart />
		</div>
	</div>
</template>

<script>
	import Cards from './Cards.vue'
	import BarChart from './BarChart.vue'
	export default {
		components:{
			Cards,
			BarChart
		}
	}
</script>