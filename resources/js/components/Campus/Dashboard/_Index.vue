<template>
	<div class="row">
	
		<div class="col-md-4 col-4">
		<Card :count="evaluators.length"  title="Total Faculty" content="click here" icon="mdi-account-multiple-remove-outline" />
		</div>
	<div class="col-md-4 col-4">
		<Card :count=" notactive.length"  title="Total Students" content="click here" icon="mdi-account-multiple-check-outline" />
		</div>
		 <div class="col-md-4 col-4">
		<Card :count="evaluators.length +  notactive.length"  title="Total Evaluators" content="click here" icon="mdi-card-account-details-outline" />
		</div>
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
			evaluators:[],
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
			this.notactive = res.data.else1
			this.evaluators = res.data.else2
			console.log('wwas',res.data.else1)
			this.active = res.data.active
			this.campus = localStorage.getItem("campus");
			})
		}
		}
	}
</script>