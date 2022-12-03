<template>
  <div
    :loading="loading"
    class="col-md-4 offset-md-4 my-16 p-0"
  >


    <v-card-item>
      <v-card-title class="text-center h1">CPSU LOGIN FORM</v-card-title>

      <v-card-subtitle>
      <div class="text-danger p-2 text-center align-middle">
        <b >{{incorrect}}</b>
        
        </div>       
      </v-card-subtitle>
    </v-card-item>

    <v-card-text>
      <v-row
        align="center"
        class="mx-0"
      >
       
      </v-row>

       <v-divider class="mx-4 mb-1"></v-divider>

       <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="username"
      :counter="10"
      :rules="UsernameRules"
      label="Username"
      required
    ></v-text-field>

    <v-text-field
    type="password"
      v-model="password"
      :rules="PasswordRules"
      label="Password"
      required
    ></v-text-field>

    <br />
    <br />
 

    <v-btn
      color="success mb-4"
      class="mr-4"
      @click="validate"
      block
      :loading="loading"
    >
      SIGN IN
    </v-btn>

 <!--    <v-btn
      color="error"
      class="mr-4"
      @click="reset"
      block
    >
      Reset Form
    </v-btn> -->

 
  </v-form>
    </v-card-text>

  </div>
</template>

<script>
  export default {
    data: () => ({
      loading:false,
      valid: true,
      username: '',
      incorrect:'',
      UsernameRules: [
        v => !!v || 'Username is required',
      ],
      password: '',
      PasswordRules: [
        v => !!v || 'Password is required',
      ],
     
    }),

    methods: {
      async validate () {
        this.incorrect = ''
        this.loading = true
        const { valid } = await this.$refs.form.validate()

        if (valid) {

           axios.post('/user_login',{
                username:this.username,
                password:this.password
            })
            .then(res=>{       
                  if(res.data.console === 'success' && res.data.status.academic_rank === 'Main Administrator Campus'){
                 // localStorage.setItem("academic_rank", res.data.status.academic_rank);
                  //  window.location ='/adminstrator/main/accounts'
                  this.incorrect =''
                   this.$router.push({path:'/administrator'})
                   localStorage.setItem("academic_rank", res.data.status.academic_rank);
                }else if(res.data.console === 'success' && res.data.status.academic_rank !== 'Main Administrator Campus'){
                  localStorage.setItem("academic_rank", res.data.status.academic_rank);
                  localStorage.setItem("campus", res.data.status.campus);
                  localStorage.setItem("campusid", res.data.status.id);
                 //  window.location ='/adminstrator/dashboard'
                 this.incorrect =''
                  this.$router.push({path:'/cpsu_campus/'+res.data.status.campus.replace(/ /g,'_')+'?'+res.data.status.id})
                }else{
                   this.incorrect = res.data.status
                }
                this.loading = false
            })
            .catch(err=>{
            //    this.$refs.form.reset()
            this.loading = false
            })

        }else{
          this.loading = false
        }
      },
      reset () {
        this.$refs.form.reset()
      },
     
    },
  }
</script>