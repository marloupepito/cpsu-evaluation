<template>
  <v-navigation-drawer
        v-model="drawer"
        class="d-flex "
        :rail="rail"
        permanent
        @click="rail = false"
      >
        <v-list-item
          prepend-avatar="/images/logo.jpg"
          :title="campus.replace(/_/g,' ').substring(5)"
          nav
        >
          <template v-slot:append>
            <v-btn
              variant="text"
              icon="mdi-chevron-left"
              @click.stop="rail = !rail"
            ></v-btn>
          </template>
        </v-list-item>

        <v-divider></v-divider>

        <v-list density="compact" nav >
          <v-list-item v-for="(i, index) in items" :to="i.to+campus+'?'+campusid" @click="clickPage(i.active,i.path)" :active="active === i.active" :prepend-icon="i.icon" :title="i.title" :value="i.title"></v-list-item>
        </v-list>

        <template v-slot:append>
          <div class="pa-2">
            <v-btn block to="/logout" color="green">
              Logout
            </v-btn>
          </div>
        </template>
      </v-navigation-drawer>
</template>


<script>
  export default {
    data () {
      return {
        active:1,
        drawer: true,
        items: [],
        rail: false,
        campusid:'',
        campus:''
      }
    },
    mounted(){
      const campusid = localStorage.getItem("campusid");
      this.campusid = campusid
      const campus = localStorage.getItem("campus").replace(/ /g,'_');
      this.campus = campus
      const path = window.location.pathname.split('/')[2]
      this.active = path=== 'CPSU_Hinoba-an_Campus'?1:
      path==='settings'?2:
      path==='faculty'?3:
      path==='results'?4:1
      this.items = [
          { title: 'Dashboard', to:'/cpsu_campus/', icon: 'mdi-monitor-dashboard', active:1 },
         // { title: 'Student',to:'/cpsu_campus/students/', icon: 'mdi-account-school-outline', active:2 },
          { title: 'Faculty',to:'/cpsu_campus/faculty/', icon: 'mdi-card-account-details-outline', active:3 },
          { title: 'Results',to:'/cpsu_campus/results/', icon: 'mdi-chart-box-outline', active:4  },
          
         { title: 'Settings',to:'/cpsu_campus/settings/', icon: 'mdi-account-cog-outline', active:2 },
        ]
        console.log('www',path)
    },
    methods:{
      clickPage(index,path){
        this.active = index
      }
    }
  }
</script>

<style>

</style>