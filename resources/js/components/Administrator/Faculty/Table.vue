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
   <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
        @input="searching"
      ></v-text-field>
  <v-table
    fixed-header
    height="74vh"
  >
    <thead>
      <tr>
        <th class="text-left">
          FACULTY ID
        </th>
        <th class="text-left">
          FULLNAME
        </th>
         <th class="text-left">
          DEPARTMENT
        </th>
         <th class="text-left">
          ACADEMIC RANK
        </th>
         <th class="text-left">
          CAMPUS
        </th>
         <th class="text-left">
          STATUS
        </th>
         <th class="text-center">
          SUBJECT LOADING
        </th>
        <th class="text-left">
          QR CODE
        </th>
         <th class="text-center">
         OPTION
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in rows"
        :key="item.name"
        id="myUL"
      >
        <td>{{ item.id_number }}</td>
        <td>{{ item.name }}</td>
        <td>{{ item.department }}</td>
        <td>{{ item.academic_rank }}</td>
        <td >
        {{item.campus}}
        </td>
        <td>
          <v-icon :color="item.status === null?'error':'success'" :icon="item.status === null?'mdi-account-cancel-outline':'mdi-account-check-outline'" size="x-large"></v-icon>
  
        </td>
        <td>
              <v-btn v-if="campusUsertype === 'Main Administrator Campus'" :to="'/administrator/faculty/'+item.campus.replace(/ /g,'_')+'/view/loaded?'+item.campusid+','+item.id" color="yellow" block>Loaded</v-btn>
              <v-btn v-else :to="'/cpsu_campus/faculty/'+item.campus.replace(/ /g,'_')+'/view/loaded?'+item.campusid+','+item.id" color="yellow" block>Loaded</v-btn>
        </td>
        <td><v-btn
      color="green" block @click="getQR([item.id,item.password])">
             <v-icon icon="mdi-qrcode" size="x-large"></v-icon>
      </v-btn></td>

      <td>
    <Menu :id="item.id"/>
        </td>
      </tr>
    </tbody>
  </v-table>
    
  </div>
</template>


<script>
import axios from 'axios'
import AddFaculty from './AddFaculty.vue'
import Menu from './Menu.vue'
  export default {
    data () {
      return {
        search: '',
        rows: [],
        rows2: [],
        campus:'',
        campusid:'',
        campusUsertype:'',
        count:0,
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
            campus:campus
          })
          .then(res=>{
            this.rows = res.data.status
            this.rows2 = res.data.status
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