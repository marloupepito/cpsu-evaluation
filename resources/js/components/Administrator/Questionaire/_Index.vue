<template lang="">
    <div>
       
        <div id="accordion" class="accordion rounded pb-2 overflow-hidden">
             <form @submit="submitQuestionaire1">
        <div class="bg-gray-800 border-0 rounded-0" no-body>
            <div header-tag="header" class="card-header bg-white pointer-cursor px-3 py-10px align-items-center">
            <div class="row">
                <div class="col-md-11 col-9"  v-b-toggle.accordion1>
                    <i class="fa fa-circle fa-fw text-green fs-8px me-2"></i> <b>Commitment</b>
                </div>
                <div class="col-md-1 col-3">
                        <v-btn :loading="loaded1" @click="submitQuestionaire1" color="green">Save</v-btn>
                </div>
            </div>
            </div>
            <div id="accordion1" accordion="my-accordion">
            <div class="bg-white pb-0">
                <b>Question 1:</b>
                <textarea v-model="q1" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 2:</b>
                <textarea v-model="q2" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 3:</b>
                <textarea v-model="q3" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 4:</b>
                <textarea v-model="q4" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white">
                <b>Question 5:</b>
                <textarea v-model="q5" class="form-control" rows="3"></textarea>
           </div>
            </div>
        </div>
        </form>
        </div>

         <div id="accordion" class="accordion rounded pb-2 overflow-hidden">
    <form @submit="submitQuestionaire2">
        <div class="bg-gray-800 border-0 rounded-0" no-body>
            <div header-tag="header" class="card-header bg-white pointer-cursor px-3 py-10px align-items-center">
           
            <div class="row">
                <div class="col-md-11 col-9"  v-b-toggle.accordion2>
                    <i class="fa fa-circle fa-fw text-green fs-8px me-2"></i> <b>Knowledge of Subject</b>
                </div>
                <div class="col-md-1 col-3">
                        <v-btn :loading="loaded2" @click="submitQuestionaire2" color="green">Save</v-btn>
                </div>
            </div>
            </div>
            <div id="accordion2" accordion="my-accordion">
            <div class="bg-white pb-0">
                <b>Question 1:</b>
                <textarea v-model="q6" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 2:</b>
                <textarea v-model="q7" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 3:</b>
                <textarea v-model="q8" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 4:</b>
                <textarea v-model="q9" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white">
                <b>Question 5:</b>
                <textarea v-model="q10" class="form-control" rows="3"></textarea>
           </div>
            </div>
        </div>
</form>
        </div>
         <div id="accordion" class="accordion rounded pb-2 overflow-hidden">
 <form @submit="submitQuestionaire3">
        <div class="bg-gray-800 border-0 rounded-0" no-body>
            <div header-tag="header" class="card-header bg-white pointer-cursor px-3 py-10px align-items-center">
           
            <div class="row">
                <div class="col-md-11 col-9"  v-b-toggle.accordion3>
                    <i class="fa fa-circle fa-fw text-green fs-8px me-2"></i> <b>Teaching for Independent Learning</b>
                </div>
                <div class="col-md-1 col-3">
                        <v-btn :loading="loaded3" @click="submitQuestionaire3"  color="green">Save</v-btn>
                </div>
            </div>
            </div>
            <div id="accordion3" accordion="my-accordion">
            <div class="bg-white pb-0">
                <b>Question 1:</b>
                <textarea v-model="q11" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 2:</b>
                <textarea v-model="q12" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 3:</b>
                <textarea v-model="q13" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 4:</b>
                <textarea v-model="q14" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white">
                <b>Question 5:</b>
                <textarea v-model="q15" class="form-control" rows="3"></textarea>
           </div>
            </div>
        </div>
</form>
        </div>
         <div id="accordion" class="accordion rounded overflow-hidden">
 <form @submit="submitQuestionaire4">
        <div class="bg-gray-800 border-0 rounded-0" no-body>
            <div header-tag="header" class="card-header bg-white pointer-cursor px-3 py-10px align-items-center">
           
            <div class="row">
                <div class="col-md-11 col-9"  v-b-toggle.accordion4>
                    <i class="fa fa-circle fa-fw text-green fs-8px me-2"></i><b> Management of Learning</b>
                </div>
                <div class="col-md-1 col-3">
                        <v-btn :loading="loaded4" @click="submitQuestionaire4"  color="green">Save</v-btn>
                </div>
            </div>
            </div>
            <div id="accordion4" accordion="my-accordion">
            <div class="bg-white pb-0">
                <b>Question 1:</b>
                <textarea v-model="q16" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 2:</b>
                <textarea v-model="q17" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 3:</b>
                <textarea v-model="q18" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white pb-0">
                <b>Question 4:</b>
                <textarea v-model="q19" class="form-control" rows="3"></textarea>
           </div>
           <div class="bg-white">
                <b>Question 5:</b>
                <textarea v-model="q20" class="form-control" rows="3"></textarea>
           </div>
            </div>
        </div>
        </form>
        </div>
    </div>
</template>
<script>
import axios  from 'axios'
const group = 'top-center';
const type = 'success';

export default {
    methods:{
        submitQuestionaire1(e){
            this.loaded1 = true
            e.preventDefault()
            axios.put('/edit_questionaire1',{
                q1:this.q1,
                q2:this.q2,
                q3:this.q3,
                q4:this.q4,
                q5:this.q5
                })
            .then(res=>{
                         this.$swal({
			                icon: 'success',
			                title: 'Your work has been saved',
			                showConfirmButton: false,
			                timer: 1500
			              })
                         this.loaded1 = false
                this.q1 = res.data.status[0].q1
                this.q2 = res.data.status[0].q2
                this.q3 = res.data.status[0].q3
                this.q4 = res.data.status[0].q4
                this.q5 = res.data.status[0].q5
            })
        },
        submitQuestionaire2(e){
             e.preventDefault()
             this.loaded2 = true
            axios.put('/edit_questionaire2',{
                q6:this.q6,
                q7:this.q7,
                q8:this.q8,
                q9:this.q9,
                q10:this.q10
                })
            .then(res=>{
                 this.$swal({
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              })
                 this.loaded2 = false
                this.q6 = res.data.status[0].q6
                this.q7 = res.data.status[0].q7
                this.q8 = res.data.status[0].q8
                this.q9 = res.data.status[0].q9
                this.q10 = res.data.status[0].q10
            })
        },
        submitQuestionaire3(e){
             e.preventDefault()
             this.loaded3 = true
            axios.put('/edit_questionaire3',{
                q11:this.q11,
                q12:this.q12,
                q13:this.q13,
                q14:this.q14,
                q15:this.q15
                })
            .then(res=>{
                 this.$swal({
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              })
                 this.loaded3 = false
                this.q11 = res.data.status[0].q11
                this.q12 = res.data.status[0].q12
                this.q13 = res.data.status[0].q13
                this.q14 = res.data.status[0].q14
                this.q15 = res.data.status[0].q15
            })
        },
        submitQuestionaire4(e){
             e.preventDefault()
             this.loaded4 = true
        axios.put('/edit_questionaire4',{
                q16:this.q16,
                q17:this.q17,
                q18:this.q18,
                q19:this.q19,
                q20:this.q20
                })
            .then(res=>{
                  this.$swal({
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              })
                  this.loaded4 = false
                this.q16 = res.data.status[0].q16
                this.q17 = res.data.status[0].q17
                this.q18 = res.data.status[0].q18
                this.q19 = res.data.status[0].q19
                this.q20 = res.data.status[0].q20
            })
        }
    },
    data: () => ({
      loaded1:false,
      loaded2:false,
      loaded3:false,
      loaded4:false,
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
    }),
    mounted(){
        axios.post('/get_questionaire')
        .then(res=>{
            console.log(res.data.status[0])
            this.q1 = res.data.status[0].q1;
            this.q2 = res.data.status[0].q2;
            this.q3 = res.data.status[0].q3;
            this.q4 = res.data.status[0].q4;
            this.q5 = res.data.status[0].q5;
            this.q6 = res.data.status[0].q6;
            this.q7 = res.data.status[0].q7;
            this.q8 = res.data.status[0].q8;
            this.q9 = res.data.status[0].q9;
            this.q10 = res.data.status[0].q10;
            this.q11 = res.data.status[0].q11;
            this.q12 = res.data.status[0].q12;
            this.q13 = res.data.status[0].q13;
            this.q14 = res.data.status[0].q14;
            this.q15 = res.data.status[0].q15;
            this.q16 = res.data.status[0].q16;
            this.q17 = res.data.status[0].q17;
            this.q18 = res.data.status[0].q18;
            this.q19 = res.data.status[0].q19;
            this.q20 = res.data.status[0].q20;
        })
    }
}
</script>
<style lang="">
    
</style>