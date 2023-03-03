
<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                  <!-- <b>Please evaluate faculties under your subject in subject.</b> -->
            </div>
            <div class="col-md-6 offset-md-3">
                <v-form ref="form" v-model="valid" lazy-validation>
                    <h3>Personal Information</h3>

                    <table class="table table-striped">
                  <tbody>
                  <tr>
                      <th>Name</th>
                      <td>{{data.name}}</td>
                    </tr>
                    <tr>
                      <th>Academic Rank</th>
                      <td>{{data.academic_rank}}</td>
                    </tr>
                    <tr>
                      <th>Department</th>
                      <td>{{data.department}}</td>
                    </tr>
                    <tr>
                      <th>Semester</th>
                      <td>{{data.semester}}</td>
                    </tr>
                    <tr>
                      <th>School Year</th>
                      <td>{{data.sy}}</td>
                    </tr> 
                  </tbody>
                </table>
                    <div class="text-danger" v-if="warn !=='' ">
                       {{ warn }}
                    </div>
                    <div class="card p-2" id="app">
                        Please input your signature here!
                        <VueSignaturePad width="100%" height="40vh" ref="signaturePad" />
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

                   
                   
                </v-form>
                <br />
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
        campus:'',
        data:[]
    }),

    mounted(){
        axios.post('/get_every_faculty2')
        .then(res=>{
            this.data =res.data.status
           
            })
    },
    methods: {
        undo(e) {
            e.preventDefault()
             this.$refs.signaturePad.undoSignature();
        },
       
        async validate() {
            this.loading=true
            const { isEmpty, data } = this.$refs.signaturePad.saveSignature();
              this.warn =''
             if(!isEmpty){
                   axios.post('/faculty_add_signature',{
                    signature:data,
                    department:this.data.department,
                    campusid:this.data.campusid
                   })
                   .then(res=>{
                        this.loading=false
                         const query = window.location.search.substring(6).split(',')
                            const type = query[0]
                            const campus = query[1]
                            const campusid = query[2]
                      //  this.$router.push({path:'/evaluation/form',query:{data:[type+','+campus.replace(/ /g,'_')+','+String(campusid)]}})
                      this.$router.push({path:'/campus/'+campus+'/faculty2'})
                    })
                }else{
                    this.loading=false
                    this.warn =' Your signature is required!'
                }
           
        },
        reset() {
            this.$refs.form.reset();
            this.$refs.signaturePad.undoSignature();
        },
      
    },
};
</script>
