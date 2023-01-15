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
          NAME
        </th>
        <th class="text-left">
          EVALUATEE ID
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
      <!--   <th class="text-left">
          SCHOOL YEAR
        </th> -->
        <th class="text-left">
          SEMESTER
        </th>
        <th class="text-left">
         OPTION
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in rows"
        :key="item.name"
      >
      <td>{{ item.name }}</td>
        <td>{{ item.evaluatee_id }}</td>
        <td>{{ item.a.length >= 4?item.a.substring(0,4):item.a }}</td>
        <td>{{ item.b.length >= 4?item.b.substring(0,4):item.b }}</td>
        <td>{{ item.c.length >= 4?item.c.substring(0,4):item.c}}</td>
        <td>{{item.d.length >= 4?item.d.substring(0,4):item.d}}</td>
        <td>{{item.e.length >= 4?item.e.substring(0,4):item.e}}</td>
        <td>{{item.semester}}</td>
        <td><v-btn @click="overAll(item.evaluatee_id)" class="text-center" size="small" color="green">Overall Results</v-btn></td>
      </tr>
    </tbody>
  </v-table>
 
	</div>
</template>


<script>
export default {
   data() {
        return {
          rows:[],
          campusid:'',
          campus:'',
          campusUsertype:'',
        }
      },
  mounted(){
    const campusid = window.location.search.substring(1)
      const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')
      this.campus =campus
      this.campusid =campusid
    axios.post('/get_all_results2',{
      status:'all'
    })
    .then(res=>{
      this.rows = Object.values(res.data.status)
      this.campusUsertype = localStorage.getItem("academic_rank");
    })
  },
  methods:{
    overAll(id){
      axios.post('/goto_overall',{
        id:id,
        campusid:this.campusid,
        campus:this.campus,
        })
      .then(res=>{
    
            if(this.campusUsertype === 'Main Administrator Campus'){
              this.$router.push({path:'/administrator/results/'+this.campus.replace(/ /g,'_')+'/view/overall'})
            }else{
              this.$router.push({path:'/cpsu_campus/results/'+this.campus.replace(/ /g,'_')+'/view/overall'})
            }
        })
    },
   
  },
}

</script>