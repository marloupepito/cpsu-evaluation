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
          block
        >
        ADD CAMPUS
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">ADD CAMPUS</span>
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
                  label="Name of Campus"
                  required
                  v-model="campusname"
                  :rules="campusnameRules"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Campus Administrator"
                  required
                  v-model="campusadmin"
                  :rules="campusadminRules"
                ></v-text-field>
              </v-col>
          

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Quality Assurance"
                  required
                  v-model="assignedPerson"
                  :rules="assignedPersonRules"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Username"
                  required
                  v-model="campususername"
                  :rules="campususernameRules"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Password"
                  required
                  v-model="campuspassword"
                  :rules="campuspasswordRules"
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
            @click="AddCPSUCampus"
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
        campusname: '',
        campusadmin: '',
        campusrank: 'Campus Administrator',
        campususername: '',
        campuspassword: '',
        assignedPerson:'',
        assignedPersonRules: [
        v => !!v || 'Quality Assurance is required',
        ],
        campusnameRules: [
        v => !!v || 'Campus is required',
        ],
        campusadminRules: [
          v => !!v || 'Campus Administrator is required',
        ],
        campususernameRules: [
          v => !!v || 'Username is required',
        ],
        campuspasswordRules: [
          v => !!v || 'Password is required',
        ],
      

      }
    },
    mounted(){
        this.loadingLocation = window.location.pathname.split('/')[1]
      this.mount();
      },
    methods:{
      mount(){

      },
        async AddCPSUCampus(){
          const { valid } = await this.$refs.form.validate()
        
        if (valid) {
          axios.post('/add_campus',{
            campusname:this.campusname,
            campusadmin:this.campusadmin,
            campusrank:this.campusrank,
            campususername:this.campususername,
            campuspassword:this.campuspassword,
            assignedPerson:this.assignedPerson
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
              this.$router.push({ path: '/administrator/faculty/campus/view/loading'})
            })
          .catch(err=>{
            this.dialog = false
               this.$swal({
                  icon: 'error',
                  title: 'Name of Campus or Username is exist!',
                  showConfirmButton: false,
                  timer: 1500
                })
            })
        }
      }
    }
  }
</script>