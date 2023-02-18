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
         <AddFaculty class="mt-3" />
        </div>
    </div>

     <div class="col-md-5 mt-3">
                <v-select
                  :items="['College of Computer Studies','College of Business Management','College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education']"
                  label="Department"
                  required
                  variant="outlined"
                  v-model="department"
                  @update:modelValue="selectDepartment"
                ></v-select>
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
        <span v-if="props.column.field == 'status'">

          <v-icon :color="props.row.status === null?'error':'success'" :icon="props.row.status === null?'mdi-account-cancel-outline':'mdi-account-check-outline'" size="x-large"></v-icon>
       
        </span> 

        <span v-if="props.column.field == 'load'">
             <v-btn v-if="campusUsertype === 'Main Administrator Campus'" :to="'/administrator/faculty/'+props.row.campus.replace(/ /g,'_')+'/view/loaded?'+props.row.campusid+','+props.row.id" color="yellow" block>Loaded</v-btn>
              <v-btn v-else :to="'/cpsu_campus/faculty/'+props.row.campus.replace(/ /g,'_')+'/view/loaded?'+props.row.campusid+','+props.row.id" color="yellow" block>Loaded</v-btn>
        </span>

         <span v-if="props.column.field == 'qr'">
           <v-btn
          color="green" block @click="getQR(['faculty',props.row.id,props.row.password])">
                 <v-icon icon="mdi-qrcode" size="x-large"></v-icon>
          </v-btn>
        </span>

        <span v-if="props.column.field == 'option'">
          <Menu :id="props.row.id"/>
        </span>

          
      </template>
      </vue-good-table>  
  </div>
</template>


<script>
import axios from 'axios'
import AddFaculty from './AddFaculty.vue'
import Menu from './Menu.vue'
  export default {
    data () {
      return {
        columns: [
        {
          label: 'Faculty ID',
          field: 'id_number',
        },
        {
          label: 'Fullname',
          field: 'name',
        },
        {
          label: 'Academic Rank',
          field: 'academic_rank',
        },
        {
          label: 'Department',
          field: 'department',
        },
       {
         label: 'Status',
         field: 'status',
       },
        {
          label: 'Loaded',
          field: 'load',
        },
        {
          label: 'QR',
          field: 'qr',
        },
        {
          label: 'Option',
          field: 'option',
        },
      ],
        search: '',
        rows: [],
        rows2: [],
        campus:'',
        campusid:'',
        campusUsertype:'',
        count:0,
        department:'College of Computer Studies'
      }
    },
   components:{
    AddFaculty,
    Menu
    },
    mounted(){
      this.mount()
    },
    methods:{
      selectDepartment(){
       this.mount()
        },
      searching(){
  
            const objects =this.rows;

            const mySearch = (arr, text) => {
              const includesValue = (word, obj) => _.some(obj, (value) => _.includes(value, word));
              const words = _.words(text); 
              return arr
                .filter((obj) => 
                  words.every((word) => 
                    includesValue(word, obj)
                  )
                );
            };
            if(this.count < this.search.length){
                this.count = this.search.length
                this.rows = mySearch(objects, this.search)

              }else{
               this.count = this.search.length-1;
               this.rows = this.rows2
              }

        },
      mount(){

      const campusid = window.location.search.substring(1)
      const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')

         axios.post('/get_faculty',{
            status:'Faculty',
            campusid:campusid,
            campus:campus,
            department:this.department
          })
          .then(res=>{
            this.rows = res.data.status
            this.rows2 = res.data.status
            console.log(res.data.status)
            this.campus = campus
            this.campusid = campusid
            this.campusUsertype = localStorage.getItem("academic_rank");
          })
          .catch(err=>{

          })
      },
      getQR(e){
        this.$swal({
          showConfirmButton: false,
          showCloseButton: true,
          imageUrl: "http://api.qrserver.com/v1/create-qr-code/?data=" + e,
          imageAlt: 'QR CODE'
          })
      },
      gotoLoaded(id){
        const pass = '?'+String(this.campusid)+','+String(id)
        console.log(pass)
        if(this.campusUsertype === 'Main Administrator Campus'){
          this.$router.push({path:'/administrator/faculty/'+this.campus.replace(/ /g,'_')+'/view/loaded'+pass})
        }else{
          this.$router.push({path:'/cpsu_campus/faculty/'+this.campus.replace(/ /g,'_')+'/view/loaded'+pass})
        }
        
      },
    },
  }
</script>