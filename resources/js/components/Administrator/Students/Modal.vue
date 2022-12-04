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
        ADD STUDENT
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">ADD STUDENT</span>
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
                  label="Student ID"
                  required
                  v-model="studentid"
                  :rules="studentidRules"
                ></v-text-field>
              </v-col>

          <!--     <v-col cols="12" sm="12">
                <v-text-field
                  label="Fullname"
                  required
                  v-model="name"
                  :rules="nameRules"
                ></v-text-field>
              </v-col> -->

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
                  label="Course"
                  required
                  v-model="course"
                  :rules="courseRules"
                ></v-select>
              </v-col>


              <v-col cols="12" sm="12">
                <v-select
                  :items="['1st Year','2nd Year','3rd Year', '4th Year']"
                  label="Year"
                  required
                  :rules="yearRules"
                  v-model="year"
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
                  :rules="semRules"
                  v-model="sem"
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
      name:'',
    //  nameRules: [
    //    v => !!v || 'Fullname is required',
    //  ],
      studentid:'',
      studentidRules: [
        v => !!v || 'Student ID is required',
      ],
      course:'',
      courseRules: [
        v => !!v || 'Course is required',
      ],
      year:'',
      yearRules: [
        v => !!v || 'Year is required',
      ],
      section:'',
      sectionRules: [
        v => !!v || 'Section is required',
      ],
      sem:'',
      semRules: [
        v => !!v || 'Semester is required',
      ],
      loadingLocation:'',
      campusid:'',
      campus:'',
      sy:'',
      syList:[]
    }),
    mounted(){
      this.loadingLocation = window.location.pathname.split('/')[1]
      const campusid = window.location.search.substring(1)
        const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')
        this.campus =campus
        this.campusid =campusid

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
    methods:{
    //  this.$refs.form.reset()
     async submitSubjectLoaded(){

        const { valid } = await this.$refs.form.validate()
        
        if (valid) {
         axios.post('/add_student',{
            campus:this.campus,
            campusid:this.campusid,
            name:this.name,
            studentid:this.studentid,
            course:this.course,
            year:this.year,
            section:this.section,
            sem:this.sem,
            status:'Regular',
            sy:this.sy
            })
          .then(res=>{
            this.dialog = false
            this.rows = res.data.status
              this.$swal({
                icon: 'success',
                title: 'Saved!',
                showConfirmButton: false,
                timer: 1000
              })
               if(this.loadingLocation === 'cpsu_campus'){
                  this.$router.push({ path: '/cpsu_campus/faculty/campus/view/loading'})
                  }else{
                    this.$router.push({ path: '/administrator/faculty/campus/view/loading'})
                  }
            })
          .catch(err=>{
            this.$swal({
                icon: 'error',
                title: 'Error!',
                showConfirmButton: false,
                timer: 1000
              })
            this.dialog = false
            })
        }


      },
    
    }
  }
</script>