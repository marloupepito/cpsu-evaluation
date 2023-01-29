<template>
    <v-card>
      <v-tabs
        v-model="tab"
        bg-color="green"
      >
        <v-tab value="Student">Students</v-tab>
        <v-tab value="Peer">Peer</v-tab>
        <!-- <v-tab value="Supervisor">Supervisor</v-tab> -->
        <v-tab value="Self">Self</v-tab>
      </v-tabs>
  
      <v-card-text>
        <v-window v-model="tab">
          <v-window-item value="Student">
           <Table1 />
          </v-window-item>
  
          <v-window-item value="Peer">
            <Table2 />
          </v-window-item>
  
         <!--  <v-window-item value="Supervisor">
            <Table3 />
          </v-window-item> -->
          <v-window-item value="Self">
            <Table4 />
          </v-window-item>
        </v-window>
      </v-card-text>
    </v-card>
  </template>

<script>
import Table1 from './Table1.vue'
import Table2 from './Table2.vue'
//import Table3 from './Table3.vue'
import Table4 from './Table4.vue'
export default {
  components:{
    Table1,
    Table2,
  //  Table3,
    Table4
  },
  data: () => ({
    tab: null,
  }),
}
</script>