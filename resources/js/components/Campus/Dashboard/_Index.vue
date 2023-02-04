<template>
	<div class="row">
		<!-- <div class="col-md-4 col-12">
		<Card :count="evaluatee.length" path="/administrator/faculty" title="Total Evaluatee" content="click here" icon="mdi-card-account-details-outline" />
		</div>
		<div class="col-md-4 col-12">
		<Card :count="notactive.length" path="/administrator/faculty" title="Not Active Evaluator" content="click here" icon="mdi-account-multiple-remove-outline" />
		</div>
		<div class="col-md-4 col-12">
		<Card :count="active.length" path="/administrator/faculty" title="Active Evaluator" content="click here" icon="mdi-account-multiple-check-outline" />
		</div>	 -->

		<div class="col-md-3 col-12">
		<img  :src=' "http://api.qrserver.com/v1/create-qr-code/?data=" + ["supervisor",data.id,data.password]' />
		</div>

		<div class="col-md-9 col-12">
			<ChartBar />
		</div>	
		
	</div>
</template>

<script>
import Card from './Card.vue'
import ChartBar from './ChartBar.vue'
	export default {
			data() {
	        return {
	         campus:'',
	         evaluator:'',
	         faculty:'',
	         active:'',
	         notactive:'',
	         campus:'',
			evaluator:[],
			evaluatee:[],
			data:[]
	        }
      },
		components:{
			Card,
			ChartBar
		},
		mounted(){
			this.mount()
			},
		methods:{
			mount(){
		const campus = localStorage.getItem("campus");
   		 const campusid = localStorage.getItem("campusid");

   		 axios.post('/users',{
   		 	id: localStorage.getItem("campusid")
   		 	})
   		 .then(res=>{
   		 	this.data = res.data.status
   		 	
   		 	})
		axios.post('/counting_data',{
			campus:campus,
			campusid:campusid
		})
		.then(res=>{
			this.evaluator = res.data.evaluators
			this.evaluatee = res.data.evaluatee
			this.active = res.data.active
			this.campus = localStorage.getItem("campus");
			this.notactive = res.data.notactive
			})
		}
		}
	}
</script>