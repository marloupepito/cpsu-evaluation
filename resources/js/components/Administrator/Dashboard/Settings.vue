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
    			this.password=res.data.password
    			})
    	},
    	submit1 () {
        this.campus = false
      },
      submit2 () {
        this.admins = false
      },
      submit3 () {
        this.user = false
      },
      submit4 () {
        this.pass =false
      },
      async validate () {
        const { valid } = await this.$refs.form.validate()

        if (valid) alert('Form is valid')
      },
      reset () {
        this.$refs.form.reset()
      },
      resetValidation () {
        this.$refs.form.resetValidation()
      },
    },
  }
</script>