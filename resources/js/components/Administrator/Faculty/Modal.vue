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
        ADD HANDLED COURSE
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Year, Course and Sections handled</span>
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
                <v-text-field
                  label="Subject"
                  required
                  :rules="subjectRules"
                  v-model="subject"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12">
                <v-select
                  :items="courselist"
                  label="Course Year"
                  required
                  v-model="courseyear"
                  :rules="courseyearRules"
                ></v-select>
              </v-col>


            <v-col cols="12" sm="12">
                <v-select
                  :items="syList"
                  label="Academic Year"
                  required
                  v-model="sy"
                  :rules="courseRules"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="12">
                <v-select
                  :items="['College of Computer Studies','College of Business Management','College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education']"
                  label="Department"
                  required
                  :rules="departmentRules"
                  v-model="department"
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

              <v-col cols="12" sm="12">
                <v-select
                  :items="['1st Semester','2nd Semester']"
                  label="Semester"
                  required
                  v-model="sem"
                  :rules="semRules"
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
      subjectList:[],
      courseyear:'',
      courselist:[],
      loaded:[],
      data:[],
      sem:'',
      subject:'',
      section:'',
      department:'',
      departmentRules: [
        v => !!v || 'Department is required',
      ],
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
      loadingLocation:'',
      sy:'',
      syList:[]
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
            sy:this.sy
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


                const a =new Date('2020').getFullYear();
        const b =new Date().getFullYear();
        const start_date = (b-a)+1;
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
       this.syList =academicYear;
       this.sy = academicYear[0]
      },
    
      // selectCourseYear(){
      //   this.subject = null
      //    axios.post('/select_course_year',{
      //     department:this.department ,
      //     year:this.courseyear,
      //     semester:this.sem
      //   })
      //   .then(res=>{
      //     this.subjectList =res.data.status.map(res=>res.subject)
      //   })
       
      // },


    }
  }
</script>