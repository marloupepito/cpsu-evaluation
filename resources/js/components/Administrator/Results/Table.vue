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

   <vue-good-table
  class="mt-3"
  compactMode
      :columns="columns"
      :rows="rows"
      :search-options="{
          enabled: true,
        }"
        :pagination-options="{
          enabled: true,
          mode: 'records'
        }"
      >
      <template #table-row="props">
        <span v-if="props.column.field == 'c'">

          {{ props.row.a.length >= 4?props.row.a.substring(0,4):props.row.a }}
       
        </span>

        <span v-if="props.column.field == 'kos'">
        {{ props.row.b.length >= 4?props.row.b.substring(0,4):props.row.b }}
        </span>

         <span v-if="props.column.field == 'til'">
           {{ props.row.c.length >= 4?props.row.c.substring(0,4):props.row.c}}
        </span>

        <span v-if="props.column.field == 'mol'">
          {{props.row.d.length >= 4?props.row.d.substring(0,4):props.row.d}}
        </span>

        <span v-if="props.column.field == 'total'">
         {{props.row.e.length >= 4?props.row.e.substring(0,4):props.row.e}}
        </span>

        <span v-if="props.column.field == 'semester'">
          {{props.row.semester}}
        </span>
          
          <span v-if="props.column.field == 'option'">
          <v-btn @click="overAll(props.row.evaluatee_id)" class="text-center" size="small" color="green">Overall Results</v-btn>
        </span>

      </template>
      </vue-good-table>  
  
	</div>
</template>


<script>
export default {
   data() {
        return {
          columns: [
        {
          label: 'Fullname',
          field: 'name',
        },
        {
          label: 'EVALUATEE ID',
          field: 'evaluatee_id',
        },
        {
          label: 'COMMITMENT',
          field: 'c',
        },
        {
          label: 'KNOWLEDGE OF SUBJECT',
          field: 'kos',
        },
        {
          label: 'TEACHING FOR INDEPENDENT LEARNING',
          field: 'til',
        },
        {
          label: 'MANAGEMENT OF LEARNING',
          field: 'mol',
        },
        {
          label: 'TOTAL',
          field: 'total',
        },
        {
          label: 'SEMESTER',
          field: 'semester',
        },
        {
          label: 'OPTION',
          field: 'option',
        },
      ],
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