<template>
    <div class="col-xl-6 col-lg-6 offset-md-3" >
		<div class="card border-0 mb-3 bg-white text-dark">
			<div class="card-body">
				<table class="table table-bordered">
					  <thead>
					    <tr class="table-secondary">
					      <th width="5%">Scale</th>
					      <th width="30%">Descriptive Rating</th>
					      <th width="65%">Qualitative Discription</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					      <td class="align-middle text-center">5</td>
					      <td class="align-middle">Outstanding</td>
					      <td>The performance must be exceeds the job requirments. The faculty is exceptional role model.</td>
					    </tr>
					    <tr>
					      <td class="align-middle text-center">4</td>
					      <td class="align-middle">Very Satisfactory</td>
					      <td>The performance meets and often exceeds tde job requirments.</td>
					    </tr>
					    <tr>
					      <td class="align-middle text-center">3</td>
					      <td class="align-middle">Satisfactory</td>
					      <td>The performance meets tde job requirments</td>
					    </tr>
					    <tr>
					      <td class="align-middle text-center">2</td>
					      <td class="align-middle">Fair</td>
					      <td>The performance need some developement to meet job requirments</td>
					    </tr>
					    <tr>
					      <td class="align-middle text-center">1</td>
					      <td class="align-middle">Poor</td>
					      <td>The faculty fails the jobs requirments.</td>
					    </tr>
					  </tbody>
				</table>

<form @submit="submitForm" id='myForm'>
<b>Evaluatee: {{evaluateeName}}</b>
<!-- <v-select :options="faculty" v-model="facultyValue" required @input="selectEvaluatee"></v-select><br /> -->
				<table class="table table-bordered">
					  <thead>
					    <tr class="table-secondary">
					      <th rowspan="2" class="align-middle text-center">Commitment</th>
					      <th colspan="5" class="text-center">Scale</th>
					    </tr>
					    <tr class="table-secondary text-center">
					      <th>5</th>
					      <th>4</th>
					      <th>3</th>
					      <th>2</th>
					      <th>1</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					     <td>{{question.q1}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q1" v-model="q1" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q1" v-model="q1" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q1" v-model="q1" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q1" v-model="q1" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q1" v-model="q1" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q2}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" v-model="q2" name="q2" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q2" v-model="q2" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q2" v-model="q2" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q2" v-model="q2" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q2" v-model="q2" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q3}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q3" v-model="q3" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q3" v-model="q3" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q3" v-model="q3" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q3" v-model="q3" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q3" v-model="q3" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q4}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q4" v-model="q4" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q4" v-model="q4" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q4" v-model="q4" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q4" v-model="q4" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q4" v-model="q4" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q5}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q5" v-model="q5" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q5" v-model="q5" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q5" v-model="q5" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q5" v-model="q5" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q5" v-model="q5" value="1" required />
					     </td>
					    </tr>
					  </tbody>
				</table>


				<table class="table table-bordered">
					  <thead>
					    <tr class="table-secondary">
					      <th rowspan="2" class="align-middle text-center">Knowledge of Subject</th>
					      <th colspan="5" class="text-center">Scale</th>
					    </tr>
					    <tr class="table-secondary text-center">
					      <th>5</th>
					      <th>4</th>
					      <th>3</th>
					      <th>2</th>
					      <th>1</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					     <td>{{question.q6}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q6" v-model="q6" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q6" v-model="q6" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q6" v-model="q6" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q6" v-model="q6" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q6" v-model="q6" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q7}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" v-model="q7" name="q7" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q7" v-model="q7" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q7" v-model="q7" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q7" v-model="q7" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q7" v-model="q7" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q8}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q8" v-model="q8" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q8" v-model="q8" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q8" v-model="q8" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q8" v-model="q8" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q8" v-model="q8" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q9}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q9" v-model="q9" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q9" v-model="q9" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q9" v-model="q9" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q9" v-model="q9" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q9" v-model="q9" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q10}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q10" v-model="q10" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q10" v-model="q10" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q10" v-model="q10" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q10" v-model="q10" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q10" v-model="q10" value="1" required />
					     </td>
					    </tr>
					  </tbody>
				</table>

				<table class="table table-bordered">
					 <thead>
					    <tr class="table-secondary">
					      <th rowspan="2" class="align-middle text-center">Teaching for Independent Learning</th>
					      <th colspan="5" class="text-center">Scale</th>
					    </tr>
					    <tr class="table-secondary text-center">
					      <th>5</th>
					      <th>4</th>
					      <th>3</th>
					      <th>2</th>
					      <th>1</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					     <td>{{question.q11}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q11" v-model="q11" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q11" v-model="q11" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q11" v-model="q11" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q11" v-model="q11" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q11" v-model="q11" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q12}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" v-model="q12" name="q12" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q12" v-model="q12" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q12" v-model="q12" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q12" v-model="q12" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q12" v-model="q12" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q13}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q13" v-model="q13" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q13" v-model="q13" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q13" v-model="q13" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q13" v-model="q13" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q13" v-model="q13" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q14}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q14" v-model="q14" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q14" v-model="q14" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q14" v-model="q14" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q14" v-model="q14" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q14" v-model="q14" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q15}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q15" v-model="q15" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q15" v-model="q15" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q15" v-model="q15" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q15" v-model="q15" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q15" v-model="q15" value="1" required />
					     </td>
					    </tr>
					  </tbody>
				</table>

				<table class="table table-bordered">
					  <thead>
					    <tr class="table-secondary">
					      <th rowspan="2" class="align-middle text-center">Management of Learning</th>
					      <th colspan="5" class="text-center">Scale</th>
					    </tr>
					    <tr class="table-secondary text-center">
					      <th>5</th>
					      <th>4</th>
					      <th>3</th>
					      <th>2</th>
					      <th>1</th>
					    </tr>
					  </thead>
					  <tbody>
					    <tr>
					     <td>{{question.q16}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q16" v-model="q16" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q16" v-model="q16" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q16" v-model="q16" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q16" v-model="q16" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q16" v-model="q16" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q17}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" v-model="q17" name="q17" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q17" v-model="q17" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q17" v-model="q17" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q17" v-model="q17" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q17" v-model="q17" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q18}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q18" v-model="q18" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q18" v-model="q18" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q18" v-model="q18" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q18" v-model="q18" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q18" v-model="q18" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q19}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q19" v-model="q19" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q19" v-model="q19" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q19" v-model="q19" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q19" v-model="q19" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q19" v-model="q19" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q20}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q20" v-model="q20" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q20" v-model="q20" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q20" v-model="q20" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q20" v-model="q20" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="radio" name="q20" v-model="q20" value="1" required />
					     </td>
					    </tr>
					  </tbody>
				</table>
<b>Comment </b>(Optional)
				<textarea v-model="comment" class="form-control" rows="3"></textarea>
				<br /><br />
				<div class="fixed-bottom">

				
				<v-btn color="green" type="submit" @submit="submitForm" :loading="disable" style="z-index:-1 !important" class="what btn btn-green btn-sm  d-block col-md-12 col-xs-12 col-sm-12 offset-md-3">SUBMIT</v-btn>
				</div>

</form>
			</div>
		</div>
    </div>
</template>


<script>
import axios from 'axios'
	export default {

		data () {
		    return {
		    	comment:null,
		    	disable:false,
		      faculty:[],
		      evaluator_id:[],
		      facultyValue:null,
		      question: null,
		      q1:null,
		      q2:null,
		      q3:null,
		      q4:null,
		      q5:null,
		      q6:null,
		      q7:null,
		      q8:null,
		      q9:null,
		      q10:null,
		      q11:null,
		      q12:null,
		      q13:null,
		      q14:null,
		      q15:null,
		      q16:null,
		      q17:null,
		      q18:null,
		      q19:null,
		      q20:null,
		      info:[],
		      question:'',
		      evaluateeName:'',
		      id2:''
		    }
		  },
		  methods:{
		  	submitForm (e){
		  		 this.disable=true
		  		e.preventDefault();
		  		const form = {
		  				id2:this.id2,
		  				campus:this.info.campus,
		  				campusid:this.info.campusid === undefined?this.info.id:this.info.campusid,
		  				name:this.evaluateeName,
		  			  comment:this.comment,
		  			  evaluator:this.evaluator_id,
		  			  evaluatee:this.facultyValue,
		  			  commitment:(parseInt(this.q1)+parseInt(this.q2)+parseInt(this.q3)+parseInt(this.q4)+parseInt(this.q5)) / 5,
		  			  kos:(parseInt(this.q6)+parseInt(this.q7)+parseInt(this.q8)+parseInt(this.q9)+parseInt(this.q10)) / 5,
		  			  til:(parseInt(this.q11)+parseInt(this.q12)+parseInt(this.q13)+parseInt(this.q14)+parseInt(this.q15)) / 5,
		  			  mol:(parseInt(this.q16)+parseInt(this.q17)+parseInt(this.q18)+parseInt(this.q19)+parseInt(this.q20)) / 5,
		  		}
		  		axios.post('/submit_form',form)
		  		.then(res=>{
		  		


						this.$swal({
						  icon: 'success',
						  title: 'Rating Submitted!',
						  showConfirmButton: false,
						  timer: 1500
						})

		  					axios.post('/get_all_faculty')
							     .then(res=>{
							     	if(res.data.status.length ===0){
							     				// window.location ='/'
							     				 this.$router.push({path:'/campuses'})
							     				axios.post('/logout_evaluator')
											    .then(res=>{
											     
											     })
							     		}else{
							     			this.id2 = res.data.status[0].id
							     			this.evaluateeName = res.data.faculty.name
							     			this.facultyValue = res.data.status[0].id_number
							     			 this.disable=false
							     			 this.comment =null
							 			 	  document.getElementById("myForm").reset();
							 			 	  
							     		}
							     })



		  			})
		  		.catch(err=>{
		  				 this.disable=false
		  			})
		  	},
		  },
		mounted(){
			axios.post('/evaluator_session')
		     .then(res=>{
		        if(res.data.status === 'success'){
		            this.info = res.data.info[0]
		            this.evaluator_id = res.data.id
		        }else{
		       //  window.location='/'
		         //  this.$router.push({path:'/campuses'})
		        }
		      })

		     axios.post('/get_questionaire')
		     .then(res=>{
		     	this.question = res.data.status[0];
		     })

		     axios.post('/get_all_faculty')
		     .then(result=>{
			     	axios.post('/get_all_faculty')
			    	 .then(res=>{
			     	if(res.data.status.length ===0){
			     	//window.location ='/'
			     	//	 this.$router.push({path:'/campuses'})
			     		}else{
			     			this.id2 = res.data.status[0].id
			     			this.evaluateeName = res.data.faculty.name
			     			this.facultyValue = res.data.status[0].id_number
			     		}
			     	})
		     })
		}
	}
</script>


<style>
.what {
   width: 50% !important;
  }
@media only screen and (max-width: 600px) {
  .what {
   width: 100% !important;
  }
}
</style>