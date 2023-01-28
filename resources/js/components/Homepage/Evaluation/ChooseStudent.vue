<!-- <template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-12">choose student</div>
            <div class="col-md-6 col-12">choose student</div>
        </div>
    </div>
</template> -->

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                  <!-- <b>Please evaluate faculties under your subject in subject.</b> -->
            </div>
            <div class="col-md-6 offset-md-3">
                <v-form ref="form" v-model="valid" lazy-validation>
                    <v-text-field
                        v-model="name"
                        :counter="10"
                        :rules="nameRules"
                        label="Fullname"
                        required
                    ></v-text-field>

                  

                    <v-select
                        v-model="course"
                        :items="['College of Computer Studies','College of Business Management','College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education']"
                  
                        :rules="[(v) => !!v || 'Course is required']"
                        label="Course"
                        required
                    ></v-select>

                    <v-select
                        v-model="year"
                        :items="['1st Year','2nd Year','3rd Year','4th Year']"
                        :rules="[(v) => !!v || 'Year is required']"
                        label="Year"
                        required
                    ></v-select>

                    <v-select
                        v-model="section"
                        :items="['Section A','Section B','Section C', 'Section D', 'Section E', 'Section F']"
                        :rules="[(v) => !!v || 'Section is required']"
                        label="Section"
                        required
                    ></v-select>
                    <div class="text-danger" v-if="warn !=='' ">
                       {{ warn }}
                    </div>
                    <div class="card p-2" id="app">
                        Please input your signature here!
                        <VueSignaturePad width="100%" height="100" ref="signaturePad" />
                        <div>
                            
                        <button class="btn btn-warning float-right" @click="undo">Undo</button>
                        </div>
                    </div>
                    <br />

                    <v-btn color="success" :loading="loading" class="me-4" @click="validate">
                        Proceed
                    </v-btn>

                    <v-btn color="error" class="me-4" @click="reset">
                        Reset Form
                    </v-btn>

                   
                   
                </v-form><br />
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        loading:false,
        valid: true,
        name: "",
        nameRules: [
            (v) => !!v || "Name is required",
        ],
        course: "",
        section: "",
        year: "",
        select: null,
        checkbox: false,
        warn:'',
        campus:''
    }),

    mounted(){
       this.campus = window.location.pathname.split('/')[2]

       const a =new Date().getFullYear();
        const b =new Date().getFullYear();
        const start_date = (b-a)+2;
        var year = new Date().getFullYear();
        var lastyear = new Date().getFullYear()+1;
        var range = [];
        var lastrange = [];
        var academicYear=[];
        lastrange.push(lastyear);
        range.push(year);
          for (var i = 1; i < start_date; i++) 
          {
            lastrange.push(lastyear - i);    
            range.push(year - i);
            academicYear.push('20'+(lastrange[i]).toString().slice(-2)+" - "+lastrange[i-1]);
            var fullyear = lastrange.concat(range);
           }
       this.sy =academicYear;
           
    },
    methods: {
        undo(e) {
            e.preventDefault()
             this.$refs.signaturePad.undoSignature();
        },
       
        async validate() {
            this.loading=true
            const { valid } = await this.$refs.form.validate();
            const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
              this.warn =''
            if (valid){
                if(!isEmpty){
                    axios.post('/add_student_info',{
                        name:this.name,
                        year:this.year,
                        course:this.course,
                        section:this.section,
                        signature:data,
                        sy:this.sy[0]
                    })
                    .then(res=>{
                        this.loading=false
                        this.$swal({
                            icon: 'success',
                            title: 'Continue!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        this.$router.push({path:'/campus/'+this.campus+'/faculty'})
                    })
                    .catch(err=>{
                        this.loading=false
                    })
                }else{
                    this.loading=false
                    this.warn =' Your signature is required!'
                }
            }else{
                this.loading=false
            };
           
        },
        reset() {
            this.$refs.form.reset();
            this.$refs.signaturePad.undoSignature();
        },
      
    },
};
</script>
