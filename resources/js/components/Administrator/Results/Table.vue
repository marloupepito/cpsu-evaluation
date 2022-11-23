<template>
	<div>
		 <v-btn
      variant="outlined"
      size="large"
      icon
      color="green"
      @click="$router.go(-1)"
    >
      <v-icon>mdi-arrow-left-bold</v-icon>
    </v-btn>

     <v-table
    fixed-header
    height="74vh"
  >
    <thead>
      <tr>
        <th class="text-left">
          NAME OF EVALUATEE
        </th>
        <th class="text-left">
          FULLNAME
        </th>
         <th class="text-left">
          COMMITMENT
        </th>
         <th class="text-left">
          KNOWLEDGE OF SUBJECT
        </th>
         <th class="text-left">
          TEACHING FOR INDEPENDENT LEARNING
        </th>
         <th class="text-left">
          MANAGEMENT OF LEARNING
        </th>
         <th class="text-left">
          TOTAL
        </th>
        <th class="text-left">
          SCHOOL YEAR
        </th>
        <th class="text-left">
          SEMESTER
        </th>
        <th class="text-left">
         ACTION
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in rows"
        :key="item.name"
      >
        <td>{{ item.evaluatee_id }}</td>
        <td>{{ item.a }}</td>
        <td>{{ item.b }}</td>
        <td>{{ item.c }}</td>
        <td>{{item.d}}</td>
        <td>{{item.e}}</td>
        <td>{{item.year}}</td>
        <td>{{item.semester}}</td>
        <td>action</td>
      </tr>
    </tbody>
  </v-table>
 
	</div>
</template>


<script>
export default {
   data() {
        return {
          rows:[]
        }
      },
  mounted(){
    axios.post('/get_all_results2',{
      status:'all'
    })
    .then(res=>{
      this.rows = res.data.status
    })
  },
  methods:{
    overAll(id){
      console.log(id)
      axios.post('/goto_overall',{
        id:id
        })
      .then(res=>{
      this.$router.push({path:'/adminstrator/results/overall'})
        })
    },
    actionFaculty (e){
      console.log(e)
      this.$swal({
      imageUrl: "http://api.qrserver.com/v1/create-qr-code/?data=" + e,
      imageAlt: 'QR CODE'
    })
    }
  },
}

</script>