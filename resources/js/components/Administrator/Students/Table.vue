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
  <v-table
    fixed-header
    height="74vh"
  >
    <thead>
      <tr>
        <th class="text-left">
          STUDENT ID
        </th>
        <th class="text-left">
          COURSE
        </th>
         <th class="text-left">
          YEAR
        </th>
         <th class="text-left">
          SECTION
        </th>
         <th class="text-left">
          STATUS
        </th>
         <th class="text-left">
          QR CODE
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="item in rows"
        :key="item.name"
      >
        <td>{{ item.id_number }}</td>
        <td>{{ item.course }}</td>
        <td>{{ item.school_year }}</td>
        <td>{{ item.section }}</td>
        <td>
     
          <v-icon :color="item.status === null?'error':'success'" :icon="item.status === null?'mdi-account-cancel-outline':'mdi-account-check-outline'" size="x-large"></v-icon>
  
        </td>
        <td><v-btn
      variant="outlined"
      color="green" @click="getQR([item.id_number,item.password])">
             <v-icon icon="mdi-qrcode" size="x-large"></v-icon>
      </v-btn></td>
      </tr>
    </tbody>
  </v-table>
    
	</div>
</template>


<script>
import axios from 'axios'
import Modal from './Modal.vue'
  export default {
    components:{
      Modal
      },
    data () {
      return {
        rows: [],
        campus:'',
        campusid:'',
      }
    },
    mounted(){
      this.mount()
    },
    methods:{
      mount(){

      const campusid = window.location.search.substring(1)
      const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')

         axios.post('/get_evaluators',{
            status:'Regular',
            campusid:campusid,
            campus:campus
          })
          .then(res=>{
            this.rows = res.data.status
            this.campus = campus
            this.campusid = campusid
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
      }
    },
  }
</script>