<template>
  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      width="500"
    >
      <template v-slot:activator="{ props }">
        <v-btn
          color="green"
          v-bind="props"
        >
        ADD LOADED SUBJECT
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">LOADED SUBJECT</span>
        </v-card-title>
        <v-card-text>
          <v-container>
      <v-form
          ref="form"
          v-model="valid"
          lazy-validation
        >
            <v-row>

              <v-col cols="12" sm="12">
                <v-select
                  :items="courselist"
                  label="Course Year"
                  required
                  v-model="courseyear"
                  :rules="courseyearRules"
                   @update:modelValue="selectCourseYear"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="12">
                <v-select
                  :items="['1st Semester','2nd Semester']"
                  label="Semester"
                  required
                  v-model="sem"
                  :rules="semRules"
                   @update:modelValue="selectCourseYear"
                ></v-select>
              </v-col>


              <v-col cols="12" sm="12">
                <v-select
                  :items="subjectList"
                  label="Subject"
                  required
                  :rules="subjectRules"
                  v-model="subject"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="12">
                <v-select
                  :items="['Section A','Section B','Section C', 'Section D', 'Section E', 'Section F']"
                  label="Section"
                  required
                  :rules="sectionRules"
                  v-model="section"
                ></v-select>
              </v-col>
           
            </v-row>

          </v-form>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="error"
            depressed
            @click="dialog = false"
            variant="outlined"
          >
            Close
          </v-btn>
          <v-btn
            color="green"
            depressed
            variant="outlined"
            @click="submitSubjectLoaded"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>


<script>
import axios from 'axios'
  export default {
    data: () => ({
      valid: true,
      dialog: false,
      campusid:'',
      department:'',
      subjectList:[],
      courseyear:'',
      courselist:[],
      loaded:[],
      data:[],
      sem:'',
      subject:'',
      section:'',
      courseyearRules: [
        v => !!v || 'Username is required',
      ],
      semRules: [
        v => !!v || 'Username is required',
      ],
      subjectRules: [
        v => !!v || 'Username is required',
      ],
      sectionRules: [
        v => !!v || 'Username is required',
      ],
      loadingLocation:''
    }),
    mounted(){
      this.loadingLocation = window.location.pathname.split('/')[1]
      this.mount()
      },
    methods:{
    //  this.$refs.form.reset()
     async submitSubjectLoaded(){

        const { valid } = await this.$refs.form.validate()
        
        if (valid) {
        axios.post('/add_subject_loaded',{
            id:this.id,
            campusid:this.campusid,
            department:this.department,
            year:this.courseyear,
            subject:this.subject,
            sem:this.sem,
            section:this.section,
          })
          .then(res=>{
            if(res.data.status === 'success'){
               this.dialog = false
                this.loaded = res.data.loading
                this.$swal({
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
              })
                
                 if(this.loadingLocation === 'cpsu_campus'){
                  this.$router.push({ path: '/cpsu_campus/faculty/campus/view/loading'})
                  }else{
                    this.$router.push({ path: '/administrator/faculty/campus/view/loading'})
                  }
            }else{
              this.$swal({
                icon: 'error',
                title: 'Subject Loaded is exist!',
                showConfirmButton: false,
              })
            }
             
          })
          .catch(err=>{
            this.$swal({
                icon: 'error',
                title: 'Your work has not been save',
                showConfirmButton: false,
                timer: 1500
              })
          })

        }
      },
      mount(){
          const aa = window.location.search.split(',')
          const campusid = aa[0].substring(1)
          const id = aa[1]
            axios.post('/get_subject_loading',{
              id:id
              })
              .then(res=>{
                this.loaded = res.data.loading
                this.data = res.data.status === null?res.data.faculty:res.data.status
                this.id = id
                this.department = res.data.status === null?res.data.faculty.department:res.data.status.department
                this.campusid=campusid
                this.courselist = [
                '1st Year',
                '2nd Year',
                '3rd Year',
                '4th Year',
                ]
              })
      },
    
      selectCourseYear(){
        this.subject = null
         axios.post('/select_course_year',{
          department:this.department ,
          year:this.courseyear,
          semester:this.sem
        })
        .then(res=>{
          this.subjectList =res.data.status.map(res=>res.subject)
        })
       
      },


    }
  }
</script>