<template>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">Name of Faculty</th>
        <!-- <th scope="col">Subject</th> -->
        <th scope="col">Semester</th>
        <th scope="col">School Year</th>
        <th scope="col">Department</th>
        <th scope="col">Print</th>
      </tr>
    </thead>
    <tbody>
      <tr  v-for="(i, n) in pdf"
          :key="n"
            v-if="value !== null && value ==='admin' "
          >
        <th>{{ i.name }}</th>
        <!-- <td>{{ i.subject }}</td> -->
        <td>{{ i.semester }}</td>
        <td>{{ i.sy }}</td>
        <td>{{ i.department }}</td>
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
    await axios.post('/get_all_overall3')
    .then(res=>{
      this.pdf =res.data.status
      console.log('waa',res.data.status)
      this.value = res.data.status[0].academic_rank
      this.where = window.location.pathname.split('/')[1]
    })
    .catch(err=>{

    })
  },
  data() {
  
    return{
      pdf:[],
      where:'',
      value:''
      
    }
  }
}
</script>