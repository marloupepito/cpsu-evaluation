<template>
	<div class="col-md-6 offset-md-3">
		<h2><v-icon
      large
      color="green darken-2"
    >
      mdi-cog
    </v-icon>
    Settings</h2>
		 <v-form ref="form">

 			<v-text-field
            :append-inner-icon="campus ? 'mdi-content-save-edit-outline' : 'mdi-reload'"
            :prepend-icon="icon"
            clear-icon="mdi-close-circle"
            label="Campus Name"
            type="text"
            @click:append-inner="submit1"
      	 	 :rules="campusNameRules"
       		 v-model="campusName"
    	  	variant='outlined'
          ></v-text-field>

          <v-text-field
            :append-inner-icon="admins ? 'mdi-content-save-edit-outline' : 'mdi-reload'"
            :prepend-icon="icon"
            clear-icon="mdi-close-circle"
            label="Administrator"
            type="text"
            @click:append-inner="submit2"
      	 	 :rules="adminRules"
       		 v-model="admin"
    	  	variant='outlined'
          ></v-text-field>

          <v-text-field
            :append-inner-icon="user ? 'mdi-content-save-edit-outline' : 'mdi-reload'"
            :prepend-icon="icon"
            clear-icon="mdi-close-circle"
            label="Username"
            type="text"
            @click:append-inner="submit3"
      	 	 :rules="userNameRules"
       		 v-model="userName"
    	  	variant='outlined'
          ></v-text-field>

          <v-text-field
            :append-inner-icon="pass ? 'mdi-content-save-edit-outline' : 'mdi-reload'"
            :prepend-icon="icon"
            clear-icon="mdi-close-circle"
            label="password"
            type="password"
            @click:append-inner="submit4"
      	 	 :rules="passwordRules"
       		 v-model="password"
    	  	variant='outlined'
          ></v-text-field>


    </v-form>
	</div>
</template>


<script>
  export default {
    data: () => ({
      id:'',
    	campus:true,
    	user:true,
    	pass:true,
    	admins:true,
      valid: true,
      campusName: '',
      campusNameRules: [
        v => !!v || 'campusName is required',
      ],
      userName: '',
      userNameRules: [
        v => !!v || 'Username is required',
      ],
       password: '',
      passwordRules: [
        v => !!v || 'Password is required',
      ],
       admin: '',
      adminRules: [
        v => !!v || 'Administrator is required',
      ],
      
    }),
		mounted(){
    	this.mount()
    	},
    methods: {
    	mount(){
    		axios.get('/user')
    		.then(res=>{
    			this.admin=res.data.name
    			this.campusName=res.data.campus
    			this.userName=res.data.username
          this.id=res.data.id
          

    			})
    	},
    	submit1 () {
        this.campus = false
          axios.post('/update_info',{
            id:this.id,
            type:'campus',
            campusName:this.campusName
            })
          .then(res=>{
            this.campus = true
               this.$swal({
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                })
            })
      },
      submit2 () {
        this.admins = false
         axios.post('/update_info',{
            id:this.id,
            type:'admin',
            admin:this.campusName
            })
          .then(res=>{
            this.admins = true
               this.$swal({
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                })
            })
      },
      submit3 () {
        this.user = false
        axios.post('/update_info',{
            id:this.id,
            type:'user',
            user:this.userName
            })
          .then(res=>{
            this.user = true
               this.$swal({
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                })
            })
            .catch(err=>{
              this.user = true
                 this.$swal({
                  icon: 'error',
                  title: 'Username already exist!',
                  showConfirmButton: false,
                  timer: 1500
                })
              })
      },
      submit4 () {
        this.pass = false
         axios.post('/update_info',{
            id:this.id,
            type:'password',
            password:this.password
            })
          .then(res=>{
            this.pass = true
               this.$swal({
                  icon: 'success',
                  title: 'Your work has been saved',
                  showConfirmButton: false,
                  timer: 1500
                })
            })
      },
 
    },
  }
</script>