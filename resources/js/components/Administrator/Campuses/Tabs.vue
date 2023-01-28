<template>
<div>
    <div class="row">
       <div class="col-md-3">   
        <Modal class="m-2 mb-4 "/>
       </div>
      <v-tabs
      v-model="tab" 
      bg-color="green"
      center-active
      next-icon="mdi-arrow-right-bold-box-outline"
      prev-icon="mdi-arrow-left-bold-box-outline"
      class="TopTopBar col-md-12"
    >
      <v-tab v-for="i in rows" :to="'/administrator/'+path+'/'+i.campus.replace(/ /g,'_')+'?'+i.id" :value="'option-'+i.id">{{i.campus}}</v-tab>
    </v-tabs>
      <v-tabs
        v-model="tab"
        direction="vertical"
        color="green"
        class="TabsTabs col-md-4 col-12 pb-5 pt-5 border-right"
      >

        <v-tab  v-for="i in rows" :value="'option-'+i.id"
           :to="'/administrator/'+path+'/'+i.campus.replace(/ /g,'_')+'?'+i.id" >
          <v-icon start>
           mdi-town-hall
          </v-icon>
          {{i.campus}}
        </v-tab>
      </v-tabs>

      <v-window v-model="tab" class="col-md-8 col-12">
        <v-window-item v-for="i in rows" :value="'option-'+i.id">
          <center>

                <v-card-text class="py-0 w-100">
                  <v-row align="center" no-gutters>
                    <v-col
                      class="text-h5 font-weight-bold"
                      cols="6"
                    >
                      {{i.campus}}
                    </v-col>

                    <v-col cols="6" class="float-right">
                      <v-img src="/images/logo.png" width="100"/>
                    </v-col>
                  </v-row>
                </v-card-text>


                
                <v-card-item :title="i.name" >
                  <template v-slot:subtitle>
                    <v-icon
                      icon="mdi-account-check-outline"
                      size="18"
                      color="error"
                      class="mr-1 pb-1"
                    ></v-icon>

                    {{i.academic_rank}}
                  </template>
                </v-card-item>
                <v-btn color="green" @click="getQR(['supervisor',i.id,i.password])">
                QRCODE
                </v-btn>
                <div class="d-flex py-2 justify-space-between">
                  <v-list-item
                    density="compact"
                    prepend-icon="mdi-account-outline"
                  >
                    <v-list-item-subtitle>Username: </v-list-item-subtitle>
                  </v-list-item>
                    <v-list-item-subtitle>{{i.username}}</v-list-item-subtitle>
                </div>

            
                <v-btn
                v-if="path !== 'campuses'"
                class="float-right"
                color="green"
                :to="'/administrator/'+path+'/'+i.campus.replace(/ /g,'_')+'/view?'+i.id"
              >
                VISIT {{i.campus}}
              </v-btn>

          </center>
        </v-window-item>

      </v-window>
    </div>
</div>
</template>

<script>
import axios from 'axios'
import Modal from './Modal.vue'
  export default {
    data: () => ({
      tab: 'option-1',
      path:'',
      rows:[],
      id:'',
      campus:''
    }),
    components:{
      Modal
      },
    mounted(){
      const path = window.location.pathname.split('/')[2]
      this.path = path
      this.mount()
    },
    methods:{
       getQR(e){
        this.$swal({
          showConfirmButton: false,
          showCloseButton: true,
          imageUrl: "http://api.qrserver.com/v1/create-qr-code/?data=" + e,
          imageAlt: 'QR CODE'
          })
      },
      mount(){
        axios.post('/get_all_users')
        .then(res=>{
          this.rows = res.data.status
          console.log(res.data.status)
          this.tab = 'option-'+window.location.search.substring(3)
             //  this.$swal({
              //    icon: 'success',
               //   title: 'Saved!',
              //    showConfirmButton: false,
             //     timer: 1000
             //   })
          })
      },
      visitCampus(id,e){
        const campus = e.replace(/ /g,'_')
        this.campus = campus
        this.id = id
        this.$router.push({path:'/administrator/'+this.path+'/'+this.campus+'/view', query:String(this.id)})
      },
      tabsClick(e,id){
        const campus = e.replace(/ /g,'_')
        this.id = String(id)
        this.$router.push({ path:'/administrator/'+this.path+'/'+campus, query:String(id)})
      }
    }
  }
</script>