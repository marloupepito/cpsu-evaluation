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
        ADD FACULTY
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
                <v-text-field
                  label="ID Number"
                  required
                  v-model="idNumber"
                  :rules="idNumberRules"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Fullname"
                  required
                  v-model="name"
                  :rules="nameRules"
                ></v-text-field>
              </v-col>


              <v-col cols="12" sm="12">
                <v-select
                  :items="['College of Computer Study','College of Business Management','College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education']"
                  label="Department"
                  required
                  :rules="departmentRules"
                  v-model="department"
                ></v-select>
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Academic Rank"
                  required
                  v-model="rank"
                  :rules="rankRules"
                ></v-text-field>
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
            @click="AddCPSUFaculty"
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
    data () {
      return {
        valid: true,
        dialog: false,
        idNumber:'',
        department:'',
        name:'',
        rank:'',
        departmentRules: [
        v => !!v || 'Department is required',
        ],
        idNumberRules: [
          v => !!v || 'ID Number is required',
        ],
        nameRules: [
          v => !!v || 'Fullname is required',
        ],
        rankRules: [
          v => !!v || 'Department Rank is required',
        ],
        campusid:'',
        campus:'',
        loadingLocation:''
      }
    },
    mounted(){
        this.loadingLocation = window.location.pathname.split('/')[1]
      this.mount();
      },
    methods:{
      mount(){
        const campusid = window.location.search.substring(1)
        const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')
        this.campusid = campusid
        this.campus = campus
      },
        async AddCPSUFaculty(){
          const { valid } = await this.$refs.form.validate()
        
        if (valid) {
          axios.post('/add_faculty',{
              idNumber:this.idNumber,
              campusid:this.campusid,
              campus:this.campus,
              name:this.name,
              department:this.department,
              rank:this.rank,
              })
            .then(res=>{
              this.dialog = false
                this.rows = res.data.status
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
            .catch(err=>{
              this.dialog = false
               this.$swal({
                  icon: 'error',
                  title: 'Error!',
                  showConfirmButton: false,
                  text: 'ID Number is exist!',
                  timer: 1500
                })
              })
        }
      }
    }
  }
</script>