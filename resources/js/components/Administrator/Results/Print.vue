<template>
    <div class="col-xl-8 col-lg-8 offset-md-2 p-0 printResult">
        <center>
            <b>Appendix A</b><br />
            <b>The QCE of the NBC No. 461</b><br />
            <b>Instrument for Instruction/Teaching Effectiveness</b><br /><br />
        </center>
        <div class="row p-3">
            <div class="col-lg-6 col-6 font-weight-bold">
                <div class="row">
                    <div class="col-md-4 col-4 pr-0">
                        Rating Period:
                    </div>
                    <div class="col-md-8 col-8">
                        <div>
                        {{answers.semester}}
                        <v-divider class="m-0 p-2"></v-divider>
                        </div>
                    </div>
                </div>
               
  
            </div>
            <div class="col-lg-6 col-6 font-weight-bold">
                <div class="row">
                    <div class="col-md-2 col-2 pr-0">
                       To
                    </div>
                    <div class="col-md-10 col-10">
                        <div>
                            {{answers.sy}}
                        <v-divider class="m-0 p-2"></v-divider>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6 font-weight-bold">
               
                <div class="row">
                    <div class="col-md-5 col-5 pr-0">
                        Name of Faculty:
                    </div>
                    <div class="col-md-7 col-7">
                        <div>
                            {{answers.faculty_name}}
                        <v-divider class="m-0 p-2"></v-divider>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-6 font-weight-bold">
                <div class="row">
                    <div class="col-md-4 col-4 pr-0">
                        Academic Rank:
                    </div>
                    <div class="col-md-8 col-8">
                        <div>
                            {{answers.academic_rank}}
                        <v-divider class="m-0 p-2"></v-divider>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-md-7 offset-md-2 col-7 offset-2">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" :checked="answers.type === 'Self'?true:false" :disabled="answers.type === 'Self'?false:true" >
                                <label class="form-check-label font-weight-bold" for="flexCheckChecked">
                                   Self
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" :checked="answers.type === 'Peer'?true:false" :disabled="answers.type === 'Peer'?false:true" >
                                <label class="form-check-label font-weight-bold" for="flexCheckChecked">
                                   Peer
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" :checked="answers.type === 'Student'?true:false" :disabled="answers.type === 'Student'?false:true" >
                                <label class="form-check-label font-weight-bold" for="flexCheckChecked">
                                   Student
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"  :checked="answers.type === 'Supervisor'?true:false" :disabled="answers.type === 'Supervisor'?false:true">
                                <label class="form-check-label font-weight-bold" for="flexCheckChecked">
                                    Supervisor
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
		<div class="card border-0 mb-3 bg-white text-dark" id="HelloWorld">
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
					     	<input class="form-check-input" type="checkbox" :checked="query[0] === '5'?true:false" name="q1" v-model="q1" value="5" required/>
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox" :checked="query[0] === '4'?true:false"  name="q1" v-model="q1" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox" :checked="query[0] === '3'?true:false"  name="q1" v-model="q1" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox" :checked="query[0] === '2'?true:false"  name="q1" v-model="q1" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox" :checked="query[0] === '1'?true:false"  name="q1" v-model="q1" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q2}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[1] === '5'?true:false" v-model="q2" name="q2" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[1] === '4'?true:false" name="q2" v-model="q2" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[1] === '3'?true:false" name="q2" v-model="q2" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[1] === '2'?true:false" name="q2" v-model="q2" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[1] === '1'?true:false" name="q2" v-model="q2" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q3}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[2] === '5'?true:false" name="q3" v-model="q3" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[2] === '4'?true:false" name="q3" v-model="q3" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[2] === '3'?true:false" name="q3" v-model="q3" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[2] === '2'?true:false" name="q3" v-model="q3" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[2] === '1'?true:false" name="q3" v-model="q3" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q4}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[3] === '5'?true:false" name="q4" v-model="q4" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[3] === '4'?true:false" name="q4" v-model="q4" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[3] === '3'?true:false" name="q4" v-model="q4" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[3] === '2'?true:false" name="q4" v-model="q4" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[3] === '1'?true:false" name="q4" v-model="q4" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q5}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[4] === '5'?true:false" name="q5" v-model="q5" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[4] === '4'?true:false" name="q5" v-model="q5" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[4] === '3'?true:false" name="q5" v-model="q5" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[4] === '2'?true:false" name="q5" v-model="q5" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[4] === '1'?true:false" name="q5" v-model="q5" value="1" required />
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
					     	<input class="form-check-input" type="checkbox"  :checked="query[5] === '5'?true:false" name="q6" v-model="q6" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[5] === '4'?true:false" name="q6" v-model="q6" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[5] === '3'?true:false" name="q6" v-model="q6" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[5] === '2'?true:false" name="q6" v-model="q6" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[5] === '1'?true:false" name="q6" v-model="q6" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q7}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[6] === '5'?true:false" v-model="q7" name="q7" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[6] === '4'?true:false" name="q7" v-model="q7" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[6] === '3'?true:false" name="q7" v-model="q7" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[6] === '2'?true:false" name="q7" v-model="q7" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[6] === '1'?true:false" name="q7" v-model="q7" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q8}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[7] === '5'?true:false" name="q8" v-model="q8" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[7] === '4'?true:false" name="q8" v-model="q8" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[7] === '3'?true:false" name="q8" v-model="q8" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[7] === '2'?true:false" name="q8" v-model="q8" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[7] === '1'?true:false" name="q8" v-model="q8" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q9}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[8] === '5'?true:false" name="q9" v-model="q9" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[8] === '4'?true:false" name="q9" v-model="q9" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[8] === '3'?true:false" name="q9" v-model="q9" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[8] === '2'?true:false" name="q9" v-model="q9" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[8] === '1'?true:false" name="q9" v-model="q9" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q10}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[9] === '5'?true:false" name="q10" v-model="q10" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[9] === '4'?true:false" name="q10" v-model="q10" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[9] === '3'?true:false" name="q10" v-model="q10" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[9] === '2'?true:false" name="q10" v-model="q10" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[9] === '1'?true:false" name="q10" v-model="q10" value="1" required />
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
					     	<input class="form-check-input" type="checkbox"  :checked="query[10] === '5'?true:false" name="q11" v-model="q11" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[10] === '4'?true:false" name="q11" v-model="q11" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[10] === '3'?true:false" name="q11" v-model="q11" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[10] === '2'?true:false" name="q11" v-model="q11" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[10] === '1'?true:false" name="q11" v-model="q11" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q12}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[11] === '5'?true:false" v-model="q12" name="q12" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[11] === '4'?true:false" name="q12" v-model="q12" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[11] === '3'?true:false" name="q12" v-model="q12" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[11] === '2'?true:false" name="q12" v-model="q12" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[11] === '1'?true:false" name="q12" v-model="q12" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q13}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[12] === '5'?true:false" name="q13" v-model="q13" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[12] === '4'?true:false" name="q13" v-model="q13" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[12] === '3'?true:false" name="q13" v-model="q13" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[12] === '2'?true:false" name="q13" v-model="q13" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[12] === '1'?true:false" name="q13" v-model="q13" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q14}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[13] === '5'?true:false" name="q14" v-model="q14" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[13] === '4'?true:false" name="q14" v-model="q14" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[13] === '3'?true:false" name="q14" v-model="q14" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[13] === '2'?true:false" name="q14" v-model="q14" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[13] === '1'?true:false" name="q14" v-model="q14" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q15}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[14] === '5'?true:false" name="q15" v-model="q15" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[14] === '4'?true:false" name="q15" v-model="q15" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[14] === '3'?true:false" name="q15" v-model="q15" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[14] === '2'?true:false" name="q15" v-model="q15" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[14] === '1'?true:false" name="q15" v-model="q15" value="1" required />
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
					     	<input class="form-check-input" type="checkbox"  :checked="query[15] === '5'?true:false" name="q16" v-model="q16" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[15] === '4'?true:false" name="q16" v-model="q16" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[15] === '3'?true:false" name="q16" v-model="q16" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[15] === '2'?true:false" name="q16" v-model="q16" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[15] === '1'?true:false" name="q16" v-model="q16" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q17}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[16] === '5'?true:false" v-model="q17" name="q17" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[16] === '4'?true:false" name="q17" v-model="q17" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[16] === '3'?true:false" name="q17" v-model="q17" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[16] === '2'?true:false" name="q17" v-model="q17" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[16] === '1'?true:false" name="q17" v-model="q17" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q18}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[17] === '5'?true:false" name="q18" v-model="q18" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[17] === '4'?true:false" name="q18" v-model="q18" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[17] === '3'?true:false" name="q18" v-model="q18" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[17] === '2'?true:false" name="q18" v-model="q18" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[17] === '1'?true:false" name="q18" v-model="q18" value="1" required />
					     </td>
					    </tr>

					    <tr>
					     <td>{{question.q19}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[18] === '5'?true:false" name="q19" v-model="q19" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[18] === '4'?true:false" name="q19" v-model="q19" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[18] === '3'?true:false" name="q19" v-model="q19" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[18] === '2'?true:false" name="q19" v-model="q19" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[18] === '1'?true:false" name="q19" v-model="q19" value="1" required />
					     </td>
					    </tr>
					    <tr>
					     <td>{{question.q20}}</td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[19] === '5'?true:false" name="q20" v-model="q20" value="5" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[19] === '4'?true:false" name="q20" v-model="q20" value="4" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[19] === '3'?true:false" name="q20" v-model="q20" value="3" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[19] === '2'?true:false" name="q20" v-model="q20" value="2" required />
					     </td>
					     <td class="align-middle text-center">
					     	<input class="form-check-input" type="checkbox"  :checked="query[19] === '1'?true:false" name="q20" v-model="q20" value="1" required />
					     </td>
					    </tr>
					  </tbody>
				</table>
                <b>Comment </b>
                    <p>
                        {{ answers.comment }}
                    </p>
             


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
                answers:[],
              question:[],
              faculty:[],
              query:[],
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

		    }
		  },
		  methods:{

         
		  	
		   mount(){
                  axios.post('/get_questionaire')
				     .then(res=>{
				     	this.question = res.data.status[0];
				     })
                     const id = window.location.search.substring(1)
                     axios.post('/get_every_result',{
                        id:id
                     })
                    .then(res=>{
                        this.answers = res.data.status
                        console.log(res.data.status)
                        this.query = Object.values(res.data.status.program2.substring(1).replace(/]/g,"").replace(/"/g,'').split(','))
                       
                    })
                    .catch(err=>{

                    })

		  },
        },
		mounted(){
			this.mount()

            
			
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


@media print
{
    .printResult
    {
        background-color:red !important;
        font-size: 12px;
    }
}

</style>