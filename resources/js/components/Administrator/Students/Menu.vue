<template>
  <div class="text-center">



     <v-dialog
      v-model="dialog"
      persistent
      width="500"
    >
      <v-card>
        <v-card-title>
          <span class="text-h5">EDIT STUDENT</span>
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
                  v-model="data.id_number"
                  :rules="studentidRules"
                ></v-text-field>
              </v-col>

         <!--      <v-col cols="12" sm="12">
                <v-text-field
                  label="Fullname"
                  required
                  v-model="name"
                  :rules="nameRules"
                ></v-text-field>
              </v-col> -->
<!-- 
              <v-col cols="12" sm="12">
                <v-select
                  :items="syList"
                  label="Academic Year"
                  required
                  v-model="sy"
                  :rules="courseRules"
                ></v-select>
              </v-col> -->

              <v-col cols="12" sm="12">
                <v-select
                  :items="['College of Computer Studies','College of Business Management','College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education']"
                  label="Course"
                  required
                  v-model="data.course"
                  :rules="courseRules"
                ></v-select>
              </v-col>


              <v-col cols="12" sm="12">
                <v-select
                  :items="['1st Year','2nd Year','3rd Year', '4th Year']"
                  label="Year"
                  required
                  :rules="yearRules"
                  v-model="data.school_year"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="12">
                <v-select
                  :items="['Section A','Section B','Section C', 'Section D', 'Section E', 'Section F']"
                  label="Section"
                  required
                  :rules="sectionRules"
                  v-model="data.section"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="12">
                <v-select
                  :items="['1st Semester','2nd Semester']"
                  label="Semester"
                  required
                  :rules="semRules"
                  v-model="data.semester"
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
    <v-menu :location="location">
      <template v-slot:activator="{ props }">
        <v-btn
          color="success"
          dark
          v-bind="props"
        >
          Dropdown
        </v-btn>
      </template>

      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          href="#"
          @click="handlerInfo(item.title,item.id)"
        >

          <v-list-item-title>{{ item.title }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>

<script>
  export default {
    props: ['id'],
    data: () => ({
      items: [
        { title: 'EDIT',id: 'EDIT' },
        { title: 'DELETE',id: 'delete' },
      ],
      locations: [
        'top',
        'bottom',
        'start',
        'end',
        'center',
      ],
      location: 'end',
      valid: true,
      dialog: false,
      campusid:'',
      name:'',
     // nameRules: [
       // v => !!v || 'Fullname is required',
      //],
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
      syList:[],
      data:[],
    }),
    methods:{
     handlerInfo(e,id){
        if(e === 'EDIT'){
          this.dialog = true
              axios.post('/get_every_evaluator',{
                  type:'faculty',
                  id:this.id,
              })
            .then(res=>{
              this.data = res.data.status
              console.log(res.data.status)
              })
          }else{

            this.$swal({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                 axios.post('/option_evaluator',{
                  option:'delete',
                  type:'student',
                  id:this.id
                  })
                .then(res=>{
                      this.dialog = false
                       this.$swal({
                        icon: 'success',
                        title: 'Saved!',
                        showConfirmButton: false,
                        timer: 1500
                      })

                       if(this.loadingLocation === 'cpsu_campus'){
                        this.$router.push({ path: '/cpsu_campus/faculty/campus/view/loading'})
                        }else{
                         this.$router.push({ path: '/administrator/faculty/campus/view/loading'})
                      }
                 })
              }
            })


          }
     },
     submitSubjectLoaded(){
       const { valid } = this.$refs.form.validate()

          axios.post('/option_evaluator',{
                option:'edit',
                type:'student',
                id:this.data.id, 
                id_number:this.data.id_number,
                course:this.data.course,
                school_year:this.data.school_year,
                section:this.data.section,
                semester:this.data.semester,
              })
            .then(res=>{

               this.dialog = false
                 this.$swal({
                  icon: 'success',
                  title: 'Saved!',
                  showConfirmButton: false,
                  timer: 1500
                })

                  if(this.loadingLocation === 'cpsu_campus'){
                  this.$router.push({ path: '/cpsu_campus/faculty/campus/view/loading'})
                  }else{
                    this.$router.push({ path: '/administrator/faculty/campus/view/loading'})
                  }

            })
     }
    }
  }
</script>