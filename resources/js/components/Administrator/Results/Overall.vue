<template>
	<div>
		   <div class="row">
        <div class="col-md-8 col-6">
            <v-btn
              variant="outlined"
              size="large"
              icon
              color="green"
              @click="$router.go(-1)"
            >
              <v-icon>mdi-arrow-left-bold</v-icon>
            </v-btn>
        </div>
         <div class="col-md-4 col-6">
         <AddFaculty class="mt-3" />
        </div>
    </div>
		<h1 class="page-header hidden-print"><!-- Overall Results --> <small>
		This is the official results</small></h1>
		<!-- END page-header -->
		<!-- BEGIN invoice -->
		<div class="invoice">
			<!-- BEGIN invoice-company -->
			<div class="invoice-company">
		<!-- 		<span class="float-end hidden-print">
					<a href="javascript:;" class="btn btn-sm btn-white mb-10px me-2"><i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
					<a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white mb-10px"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
				</span> -->
				Overall Results from Evaluators
			</div>
			<!-- END invoice-company -->
			<!-- BEGIN invoice-header -->
			<div class="invoice-header">
				<div class="row">
						<div class="col-md-9 col-8">
								<div class="invoice-from">

							<div class="date text-dark mt-3px">August 3,2021</div>
									<address class="mt-3 mb-5px">
									<strong class="text-dark">{{evaluateeName}}</strong><br />
										<strong class="text-dark">{{aaa}}</strong><br />
										Faculty<br />
										Central Philippines State University<br />
										DJVV San Carlos Campus<br />
									</address>
								</div>
						</div>
						<div class="col-md-3 col-4">
								<img class="mt-2 mb-2" src="/images/a.jpg" width="100%" />
						</div>
				</div>
		
				
			</div>
			<!-- END invoice-header -->
			<!-- BEGIN invoice-content -->
			<div class="invoice-content">
				<!-- BEGIN table-responsive -->
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th width="25%"><h5>Evaluators</h5></th>
								<th class="text-center" width="25%"><h5>Result</h5></th>
								<th class="text-center" width="25%"><h5>Percent</h5></th>
							</tr>
						</thead>
						<tbody>

							<tr>
								<td>
									<b>Student</b>
								</td>
								<td class="text-center">{{student}}</td>
								<td class="text-center">{{(parseFloat((student * .20)).toString().substr(0, 4))}}</td>
						
							</tr>
							<tr>
								<td>
										<b>Peer</b>
								</td>
								<td class="text-center">{{peer}}</td>

								<td class="text-center">{{(parseFloat((peer * .20)).toString().substr(0, 4))}}</td>

							</tr>
							<tr>
								<td>
										<b>Self</b>
								</td>
								<td class="text-center">{{self}}</td>
								<td class="text-center">{{(parseFloat((self * .30)).toString().substr(0, 4))}}</td>
						
							</tr>
							<tr>
								<td>
										<b>Supervisor</b>
								</td>
								<td class="text-center">{{supervisor}}</td>
								<td class="text-center">{{(parseFloat((supervisor * .30)).toString().substr(0, 4))}}</td>
						
							</tr>
						</tbody>
					</table>
				</div>
				<!-- END table-responsive -->
				
				<table class="table table-striped">
						<thead>
							<tr>
								<th width="25%"><h3>TOTAL</h3></th>
								<th class="text-center" width="25%"><h3>{{
									((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4)
									 }}</h3></th>
								<th class="text-center" width="25%"><h3>
															<div v-if=" 	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 1 && 
                     	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 2">
                <h3>Poor</h3>
                      
          </div>
             <div v-else-if=" 	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 2 && 
                      	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 3">
                      
                    <h3>Fair</h3>
          </div>

             <div style="font-size: 150%;" v-else-if="	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4)<= 3 && 
                    	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 4">
                      
                  <h3>Satisfactory</h3>
          </div>

             <div v-else-if=" 	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 4 && 
                      	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 5">
                    
                  <h3>very Satisfactory</h3>
          </div>

 <div v-else-if="((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 5 && 
                    	((parseFloat(student)*.20)+(parseFloat(peer)*.20)+(parseFloat(self)*.30)+(parseFloat(supervisor) *.30)).toString().substr(0, 4) <= 6">
                
                   
                 <h3>Outstanding</h3>
          </div>
								</h3></th>
							</tr>
						</thead>
					</table>

				<!-- END invoice-price -->
			</div>
			<!-- END invoice-content -->

<Tabs />




		</div>
		<!-- END invoice -->
	</div>
</template>


<script>
import axios from 'axios'
import Tabs from './Tabs.vue'
export default {
	components:{
		Tabs
	},
  async mounted(){
		await axios.post('/get_all_overall')
		.then(res=>{
			console.log(this.$route.query.student)
			this.student = this.$route.query.student
			this.peer = this.$route.query.peer
			this.self = this.$route.query.self
			this.supervisor = this.$route.query.supervisor
			this.aaa =res.data.status[0].name
			this.info1 = res.data.status2
			this.pdf =res.data.pdf
			this.a = res.data.status2.a.length
			this.b = res.data.status2.b.length
			this.c = res.data.status2.c.length
			this.d = res.data.status2.d.length
			this.e = res.data.status2.e.length
			// localStorage.setItem("year",res.data.ccs.map(a=>a.year)); 
			const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')
			this.campus =campus
			this.campusid =campusid
			this.evaluateeName =this.comments[0].name
			localStorage.setItem("ccs",res.data.ccs.map(a=>a.ccs));
			localStorage.setItem("cte",res.data.cte.map(a=>a.cte)); 
			localStorage.setItem("cbm",res.data.cbm.map(a=>a.cbm)); 
		  localStorage.setItem("caf",res.data.caf.map(a=>a.caf)); 
			localStorage.setItem("ccje",res.data.ccje.map(a=>a.ccje)); 
	
		})
		.catch(err=>{

		})
  },
	data() {
		const year = localStorage.getItem("year");
		const ccs = localStorage.getItem("ccs");
		const cte = localStorage.getItem("cte");
		const cbm = localStorage.getItem("cbm");
		const caf = localStorage.getItem("caf");
		const ccje = localStorage.getItem("ccje");
	
		return{
			student:'',
			peer:'',
			self:'',
			Supervisor:'',
			aaa:'',
			campus:'',
			campusid:'',
			evaluateeName:'',
			pdf:[],
			info1:'',
			ccs:'',
			cbm:'',
			caf:'',
			cte:'',
			ccje:'',
			a:'',
			b:'',
			c:'',
			d:'',
			e:''
			
		}
	}
}
</script>