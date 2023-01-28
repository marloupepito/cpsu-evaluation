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
          title="SUPERADMIN"
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
          <v-list-item v-for="(i, index) in items" @click="clickPage(i.active,i.path)" :active="active === i.active" :prepend-icon="i.icon" :title="i.title" :value="i.title"></v-list-item>
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
        items: [
          { title: 'Dashboard', path:'/administrator', icon: 'mdi-monitor-dashboard', active:1 },
          { title: 'Campuses',path:'/administrator/campuses', icon: 'mdi-town-hall', active:2 },
          //{ title: 'Student',path:'/administrator/students', icon: 'mdi-account-school-outline', active:3 },
          { title: 'Faculty',path:'/administrator/faculty', icon: 'mdi-card-account-details-outline', active:4 },
          { title: 'Results',path:'/administrator/results', icon: 'mdi-chart-box-outline', active:5  },
         // { title: 'Schedule',path:'/administrator/schedule', icon: 'mdi-calendar-outline', active:6  },
          { title: 'Questionaire',path:'/administrator/questionaire', icon: 'mdi-timeline-question-outline', active:7 },
        ],
        rail: false,
      }
    },
    mounted(){
      const path = window.location.pathname.split('/')[2]
      this.active = path=== undefined?1:
      path==='campuses'?2:
      path==='students'?3:
      path==='faculty'?4:
      path==='results'?5:
      path==='schedule'?6:
      path==='questionaire'?7:8

    },
    methods:{
      clickPage(index,path){
        this.active = index
        this.$router.push({path:path})
      }
    }
  }
</script>

<style>

</style>