<template>
  <div class=" col-md-12 col-sm-12 col-12">
  <v-card
    class="mx-auto p-1 mb-5"
  >
    <template v-slot:title>
      <v-badge class='p-2' :content="count" color="error">
        <v-icon>{{icon}}</v-icon>
      </v-badge>
    {{title}}
    </template>
<!--     <v-expansion-panels
     v-model="cardid"
      multiple>
          <v-expansion-panel>
            <v-expansion-panel-title>Click here!</v-expansion-panel-title>
            <v-expansion-panel-text>
             <Treeview />
            </v-expansion-panel-text>
          </v-expansion-panel>
      </v-expansion-panels> -->
    <v-card-text>
    
    </v-card-text>
  </v-card>
  </div>
</template>

<script>
  export default {
     data () {
      return {
        cardid:this.path,
      }
    },
    components:{
    },
    props:[
          'title',
          'content',
          'icon',
          'path',
          'count',
        ],
     created() {
      // props are exposed on `this`
      console.log(this.title)
    }
  }
</script>