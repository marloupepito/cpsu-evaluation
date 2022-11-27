<template>
  <v-timeline side="end" align="start">
    <v-timeline-item
      dot-color="green"
      size="small"
      v-for="i in campuses"
    >
    
     <v-menu location="end">
     <template v-slot:activator="{ props }">
        <v-btn
          color="green"
          dark
          block
          v-bind="props"
        >
         {{i.campus.substring(0,i.campus.length -7)}}
        </v-btn>
      </template>

        <v-list>
          <v-list-item
            v-for="(item, index) in items"
            :key="index"
          >
            <v-list-item-title>{{ item.title }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
    </v-timeline-item>
  </v-timeline>
</template>

<script>
import axios from 'axios'
  export default {
     data: () => ({
      campuses: [],
        items: [
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me' },
        { title: 'Click Me 2' },
      ],

    }),
    mounted(){
      this.campus()
    },
    methods:{
      campus(){
        axios.post('/get_all_users')
        .then(res=>{
          this.campuses = res.data.status
        })
      }
    }
  }
</script>