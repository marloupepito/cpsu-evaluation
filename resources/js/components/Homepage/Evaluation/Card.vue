<template>
	<div  class="col-md-6 offset-md-3">
<v-container fluid>
      <v-row dense>
        <v-col
          v-for="card in cards"
          :key="card.title"
          :cols="card.flex"
        >
          <v-card>
            <v-img
              :src="card.src"
              class="white--text align-end"
              gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
              height="200px"
            >
              <v-card-title v-text="card.title"></v-card-title>
            </v-img>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn icon
              variant="outlined"
              size="large"
              color="green"
               :to="'/evaluation/scan_qr?'+card.type+','+campus+'#'+campusid">
                <v-icon>mdi-qrcode-scan</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
    </div>
</template>

<script>
  export default {
    data: () => ({
      cards: [],
      campus:'',
      campusid:''
    }),
    mounted(){
    	const campus = window.location.search.substring(1).replace(/ /g,'_')
        const id = window.location.hash.substring(1)
        this.campus = campus
        this.campusid = id
    	this.cards =[
        { title: 'Student', src: '/images/a.jpg', flex: 6,type:'student' },
        { title: 'Peer', src: '/images/a.jpg', flex: 6, type:'peer' }, 
        { title: 'Self', src: '/images/a.jpg', flex: 6, type:'self' },
        { title: 'Supervisor', src: '/images/a.jpg', flex: 6, type:'supervisor' },
      ]
    }	
  }
</script>