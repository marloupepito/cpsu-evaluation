<template>
	<div>
	   <div class="row">
        <div class="col-md-8 col-6">
            <v-btn
              variant="outlined"
              size="large"
              icon
              color="green"
              @click="$router.go(-1)"
            >
              <v-icon>mdi-arrow-left-bold</v-icon>
            </v-btn>
        </div>
         <div class="col-md-4 col-6">
            <Modal class="mt-3"/>
        </div>
    </div>

	<v-card
	    class="mx-auto container mt-4"
	    max-width="100vw"
	    rounded="0"
	    style="height:35vh"
	  >
	    <v-img
	      height="100%"
	      cover
	      src="/images/background.jpeg"
	    >
	      <v-avatar
	        color="grey"
	        size="150"
	        rounded="0"
	      >
	        <v-img cover src="https://cdn.vuetifyjs.com/images/profiles/marcus.jpg"></v-img>
	      </v-avatar>
	      <v-list-item
	        class="text-white"
	        :title="data.name+' - '+data.academic_rank"
	        :subtitle="data.campus"
	      ></v-list-item>
	    </v-img>
	  </v-card>

 	<div class="row pt-5">
	 	<div class="col-md-4 mb-5"
			v-for="(item, i) in loaded"
	      :key="i">
	 	 <v-card
		    prepend-icon="mdi-book-information-variant"
		  >
		    <template v-slot:title>
		     {{item.subject}}
		    </template>

		    <v-card-text>
		      	<div class="row">
							<div class="col-md-4">
							<b class="text-dark">Subject:</b>
							</div>
							<div class="col-md-8">
								{{item.subject}}
							</div>
							<div class="col-md-4">
									<b class="text-dark">Semester:</b>
							</div>
							<div class="col-md-8">
								{{item.semester}}
							</div>
							<div class="col-md-4">
								<b class="text-dark">Year:</b>
							</div>
							<div class="col-md-8">
								{{item.year}}
							</div>
							<div class="col-md-4">
									<b class="text-dark">Section:</b>
							</div>
							<div class="col-md-8">
								{{item.section}}
							</div>
					</div>
		    </v-card-text>
		  </v-card>
	 	</div>
 	</div>

      
    
	</div>
</template>


<script>
import axios from 'axios'
import Modal from './Modal.vue'
  export default {
    data: () => ({
      loaded: [],
        campusid:'',
		department:'',
		subjectList:[],
		courseyear:[],
		courselist:[],
		data:[],
		name:''
    }),
    mounted(){
    	this.mount()
    },
     components:{
      Modal
      },
    methods:{
    	mount(){
    		const aa = window.location.search.split(',')
    		const campusid = aa[0].substring(1)
    		const id = aa[1]
    
					axios.post('/get_subject_loading',{
					id:id
				})
				.then(res=>{
					this.data = res.data.status === null?res.data.faculty:res.data.status

					this.courselist = [
					'1st Year',
					'2nd Year',
					'3rd Year',
					'4th Year',
					]
					this.id = id
					this.loaded = res.data.loading
					this.campusid=campusid
					this.department = res.data.status === null?res.data.faculty.department:res.data.status.department
					
				})
    	}
    },
  }
</script>