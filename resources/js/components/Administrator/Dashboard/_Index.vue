<template>
	<div class="row">
		<div class="col-md-4">
		<Cards :count="campus" path="/administrator/campuses" title="Total Campuses" content="click here" icon="mdi-town-hall"/>
		<Cards :count="evaluator" path="/administrator/students" title="Total Students" content="click here" icon="mdi-account-school-outline" />
		<Cards :count="faculty" path="/administrator/faculty" title="Total Faculty" content="click here" icon="mdi-card-account-details-outline" />
		<Cards :count="active" path="/administrator/faculty" title="Active Evaluator" content="click here" icon="mdi-account-multiple-check-outline" />
		<Cards :count="notactive" path="/administrator/faculty" title="Not Active Evaluator" content="click here" icon="mdi-account-multiple-remove-outline" />
		</div>
		<div class="col-md-8">
			<BarChart />
		</div>
	</div>
</template>

<script>
import axios from 'axios'
	import Cards from './Cards.vue'
	import BarChart from './BarChart.vue'
	export default {
		components:{
			Cards,
			BarChart
		},
		data() {
	        return {
	         campus:'',
	         evaluator:'',
	         faculty:'',
	         active:'',
	         notactive:''
	        }
      },
      mounted(){
      	this.mount()
      	},
		methods:{
			mount(){
				axios.post('/get_all_admin_dashboard_data')
				.then(res=>{
					this.campus = res.data.campus.length
					this.evaluator = res.data.evaluator.length
					this.faculty = res.data.faculty.length
					this.active = res.data.active.length + res.data.active2.length
					this.notactive = res.data.notactive.length + res.data.notactive2.length
				})
			}
		}
	}
</script>