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

	
	      <h2 class="mt-2">{{data.name+' - '+data.academic_rank}}</h2>
	       <h3>{{data.name+' - '+data.campus}}</h3>
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

				<table class="table table-striped">
				<tbody>
					<tr>
					<th scope="row">Subject:</th>
					<td>{{item.subject}}</td>
					</tr>
					<tr>
					<th scope="row">Semester:</th>
					<td>{{item.semester}}</td>
					</tr>
					<tr>
					<th scope="row">Year:</th>
					<td>{{item.year}}</td>
					</tr>
					<tr>
					<th scope="row">Department:</th>
					<td>{{item.department}}</td>
					</tr>
					<tr>
					<th scope="row">Section:</th>
					<td>{{item.section}}</td>
					</tr>
				</tbody>
				</table>
<br /><br />
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