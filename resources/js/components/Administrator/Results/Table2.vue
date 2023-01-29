<template>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Faculty ID</th>
        <th scope="col">Subject</th>
        <th scope="col">Semester</th>
        <th scope="col">School Year</th>
        <th scope="col">Section</th>
        <th scope="col">Print</th>
      </tr>
    </thead>
    <tbody>
      <tr  v-for="(i, n) in pdf"
          :key="n">
        <th>{{ i.unique_id }}</th>
        <td>{{ i.subject }}</td>
        <td>{{ i.semester }}</td>
        <td>{{ i.sy }}</td>
        <td>{{ i.section }}</td>
        <td>
          <v-btn
              fab
              dark
              size="small"
              block
              color="green"
              :href="'/'+where+'/results/'+i.campus.replace(/ /g,'_')+'/view/print2?'+i.id"
               target="_blank"
              >
              <v-icon dark>
                  mdi-printer
              </v-icon>
              </v-btn>
        </td>
      </tr>
    </tbody>
  </table>
</template>



<script>
import axios from 'axios'
export default {
	components:{
	},
  async mounted(){
		await axios.post('/get_all_overall2')
		.then(res=>{
			this.pdf =res.data.status
      console.log(res.data.console)
      this.where = window.location.pathname.split('/')[1]
		})
		.catch(err=>{

		})
  },
	data() {
	
		return{
			pdf:[],
      where:''
			
		}
	}
}
</script>