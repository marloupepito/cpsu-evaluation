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
   <div class="col-md-5 mt-3">
            <!--     <v-select
                  :items="['College of Computer Studies','College of Business Management','College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education']"
                  label="Department"
                  required
                  variant="outlined"
                  v-model="department"
                  @update:modelValue="selectDepartment"
                ></v-select> -->
              </div>
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
        <span v-if="props.column.field == 'student'">  
          {{ props.row.student }}
        </span>
         <span v-if="props.column.field == 'p1'">  
           <v-badge
          color="success"
          :content="(props.row.student * .20).toString().substr(0, 4)"
          inline
        >
        </v-badge>
        </span>

        <span v-if="props.column.field == 'peer'">
        {{ props.row.peer }}
        </span>

          <span v-if="props.column.field == 'p2'">  
           <v-badge
          color="success"
          :content="(props.row.peer * .20).toString().substr(0, 4)"
          inline
        >
        </v-badge>
        </span>

         <span v-if="props.column.field == 'self'">
            {{ props.row.self }}
        </span>

          <span v-if="props.column.field == 'p3'"> 
            <v-badge
          color="success"
          :content="(props.row.self * .30).toString().substr(0, 4)"
          inline
        >
        </v-badge> 
        </span>

        <span v-if="props.column.field == 'supervisor'">
          {{ props.row.supervisor }}
        </span>

          <span v-if="props.column.field == 'p4'">  
             <v-badge
          color="success"
          :content="(props.row.supervisor * .30).toString().substr(0, 4)"
          inline
        >
        </v-badge>
        </span>

        <span v-if="props.column.field == 'total'" >
  <v-badge
          color="success"
          :content=" (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4)"
          inline
        >
        </v-badge>
        </span>

        <span v-if="props.column.field == 'remarks'">
          <div v-if=" (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 1 && 
                      (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 2">
                  <v-badge
                  color="danger"
                  content="Poor"
                  inline
                >
                </v-badge>
                      
          </div>
             <div v-else-if=" (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 2 && 
                      (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 3">
                      
                        <v-badge
                  color="warning"
                  content="Fair"
                  inline
                >
                </v-badge>
          </div>

             <div v-else-if=" (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 3 && 
                      (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 4">
                      
                          <v-badge

                  color="light-blue-lighten-2"
                  content="Satisfactory"
                  inline
                >
                </v-badge>
          </div>

             <div v-else-if=" (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 4 && 
                      (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 5">
                    
                             <v-badge
                  color="lime-darken-1"
                  content="Very Satisfactory"
                  inline
                >
                </v-badge>
          </div>

 <div v-else-if=" (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 5 && 
                      (parseFloat((props.row.student * .20))
                      +parseFloat((props.row.peer * .20))
                      +parseFloat((props.row.self * .30))
                      +parseFloat((props.row.supervisor * .30))).toString().substr(0, 4) <= 6">
                
                              <v-badge
                  color="success"
                  content="Outstanding"
                  inline
                >
                </v-badge>
          </div>

   

        </span>
          
          <span v-if="props.column.field == 'option'">
          <v-btn @click="overAll(props.row.faculty_id,props.row.student,props.row.peer,props.row.self,props.row.supervisor)" class="text-center" size="small" color="green">Overall Results</v-btn>
        </span>

      </template>
      </vue-good-table>  
  
	</div>
</template>


<script>
export default {
   data() {
        return {
          department:'College of Computer Studies',
          columns: [
        {
          label: 'Fullname',
          field: 'faculty_name',
        },
        {
          label: 'Student',
          field: 'student',
        },
         {
          label: '20%',
          field: 'p1',
        },
        {
          label: 'Peer',
          field: 'peer',
        },
         {
          label: '20%',
          field: 'p2',
        },
        {
          label: 'Self',
          field: 'self',
        },
         {
          label: '30%',
          field: 'p3',
        },
        {
          label: 'Supervisor',
          field: 'supervisor',
        },
         {
          label: '30%',
          field: 'p4',
        },
        {
          label: 'Overall',
          field: 'total',
        },
        {
          label: 'Remarks',
          field: 'remarks',
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
    this.mount()
  },
  methods:{
    selectDepartment(){
       this.mount()
        },
        mount(){
          const campusid = window.location.search.substring(1)
          const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')
          this.campus =campus
          this.campusid =campusid
        axios.post('/get_all_results2',{
          status:'all',
          department:this.department,
          campusid:campusid
        })
        .then(res=>{  
       //   console.log('x',res)
          axios.post('/get_all_results3',{
            data:Object.values(res.data.status),
          })
          .then(resss=>{
            console.log(resss.data.status)
            this.rows = Object.values(resss.data.status)
            })
          this.campusUsertype = localStorage.getItem("academic_rank");
        })
    },
    overAll(id,student,peer,self,supervisor){
      axios.post('/goto_overall',{
        id:id,
        campusid:this.campusid,
        campus:this.campus,
        })
      .then(res=>{

            if(this.campusUsertype === 'Main Administrator Campus'){
              this.$router.push({path:'/administrator/results/'+this.campus.replace(/ /g,'_')+'/view/overall',query:{
                student:student,
                peer:peer,
                self:self,
                supervisor:supervisor
                }})
            }else{
              this.$router.push({path:'/cpsu_campus/results/'+this.campus.replace(/ /g,'_')+'/view/overall',query:{
                student:student,
                peer:peer,
                self:self,
                supervisor:supervisor
                }})
            }
        })
    },
   
  },
}

</script>