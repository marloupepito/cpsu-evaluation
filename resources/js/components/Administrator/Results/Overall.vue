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
										<strong class="text-dark">{{info1.evaluatee_id}}</strong><br />
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
								<th width="50%"><h5>TOTAL</h5></th>
								<th class="text-center" width="25%"><h5>MAIN</h5></th>
								<th class="text-center" width="25%"><h5>INTERPRETATION</h5></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<b>A. Commitment</b>
								</td>
								<td class="text-center">{{a >= 4?info1.a.substring(0,4):info1.a}}</td>
								<td class="text-center">
									{{
										info1.a <= 1 && info1.a <= 2?"Poor":
										info1.a <= 2 && info1.a <= 3?"Fair":
										info1.a <= 3 && info1.a <= 4?"Satisfactory":
										info1.a <= 4 && info1.a <= 5?"Very Satisfactory":
										info1.a <= 5 && info1.a <= 6?"Outstanding":""	
									}}
								</td>
							</tr>
							<tr>
								<td>
										<b>B. Knowledge of Subject</b>
								</td>
								<td class="text-center">{{b >= 4?info1.b.substring(0,4):info1.b}}</td>
								<td class="text-center">
									{{
										info1.b <= 1 && info1.b <= 2?"Poor":
										info1.b <= 2 && info1.b <= 3?"Fair":
										info1.b <= 3 && info1.b <= 4?"Satisfactory":
										info1.b <= 4 && info1.b <= 5?"Very Satisfactory":
										info1.b <= 5 && info1.b <= 6?"Outstanding":""	
									}}
								</td>
							</tr>
							<tr>
								<td>
										<b>C. Teaching for Independent Learning</b>
								</td>
								<td class="text-center">{{c >= 4?info1.c.substring(0,4):info1.c}}</td>
								<td class="text-center">
									{{
										info1.c <= 1 && info1.c <= 2?"Poor":
										info1.c <= 2 && info1.c <= 3?"Fair":
										info1.c <= 3 && info1.c <= 4?"Satisfactory":
										info1.c <= 4 && info1.c <= 5?"Very Satisfactory":
										info1.c <= 5 && info1.c <= 6?"Outstanding":""	
									}}</td>
							</tr>
							<tr>
								<td>
										<b>D. Management of Learning</b>
								</td>
								<td class="text-center">{{d >= 4?info1.d.substring(0,4):info1.d}}</td>
								<td class="text-center">
										{{
										info1.d <= 1 && info1.d <= 2?"Poor":
										info1.d <= 2 && info1.d <= 3?"Fair":
										info1.d <= 3 && info1.d <= 4?"Satisfactory":
										info1.d <= 4 && info1.d <= 5?"Very Satisfactory":
										info1.d <= 5 && info1.d <= 6?"Outstanding":""	
									}}
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- END table-responsive -->
				
				<table class="table table-striped">
						<thead>
							<tr>
								<th width="50%"><h3>TOTAL</h3></th>
								<th class="text-center" width="25%"><h3>{{e >= 4?info1.e.substring(0,4):info1.e}}</h3></th>
								<th class="text-center" width="25%"><h3>
										{{
										info1.e <= 1 && info1.e <= 2?"Poor":
										info1.e <= 2 && info1.e <= 3?"Fair":
										info1.e <= 3 && info1.e <= 4?"Satisfactory":
										info1.e <= 4 && info1.e <= 5?"Very Satisfactory":
										info1.e <= 5 && info1.e <= 6?"Outstanding":""	
									}}
								</h3></th>
							</tr>
						</thead>
					</table>

				<!-- END invoice-price -->
			</div>
			<!-- END invoice-content -->

			<v-timeline
      :reverse="false"
      dense
    >
      <v-timeline-item
       v-for="(item, n) in comments"
        :key="n"
        color="green lighten-1"
      >
        <v-card class="elevation-2">
          <v-card-title class="text-h5">
           Evaluator Comment
          </v-card-title>
          <v-card-text>

          {{item.comment}}
          </v-card-text>
        </v-card>
      </v-timeline-item>
    </v-timeline>


		</div>
		<!-- END invoice -->
	</div>
</template>


<script>
import axios from 'axios'

export default {

  async mounted(){
		await axios.post('/get_all_overall')
		.then(res=>{
			this.info1 = res.data.status2
			this.comments =res.data.status
			this.a = res.data.status2.a.length
			this.b = res.data.status2.b.length
			this.c = res.data.status2.c.length
			this.d = res.data.status2.d.length
			this.e = res.data.status2.e.length
			// localStorage.setItem("year",res.data.ccs.map(a=>a.year)); 
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
			evaluateeName:'',
			comments:[],
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