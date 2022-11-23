<template>
  <div>
  	<v-card
    :loading="loading"
    class="mx-auto my-12 mt-0"
    max-width="374"
  >
    <template v-slot:loader="{ isActive }">
      <v-progress-linear
        :active="isActive"
        color="deep-purple"
        height="4"
        indeterminate
      ></v-progress-linear>
    </template>

    <v-img
      cover
      height="250"
      src="/images/a.jpg"
    ></v-img>

    <v-card-item>
      <v-card-title>{{campus}}</v-card-title>

      <v-card-subtitle>
        <span class="mr-1">Central Philippine State University</span>

        <v-icon
          color="error"
          icon="mdi-fire-circle"
          size="small"
        ></v-icon>
      </v-card-subtitle>
    </v-card-item>

    <v-card-text>
    
              <div class="text-gray-500 small mb-15px text-truncate">
                  {{timerStatus}}<br />
                  <b class="text-green">
                  {{timerCount}}
                  </b>
                  <b :class="hide">
                  {{timerCount2}}
                  </b>
                </div>
                 <v-divider class="mx-4"></v-divider>
                <v-btn block color="green"  :to="'/evaluation/categories?'+this.campus+'#'+this.campusid" :disabled="buttonDisable">EVALUATE NOW!</v-btn>
    </v-card-text>

    <v-divider class="mx-4 mb-1"></v-divider>

    <v-card-title>How System Works</v-card-title>

    <div class="px-4">
      <p>Evaluation system is a systematic way to examine how well an employee is performing in his or her job. If you notice, the word systematic implies the performance evaluation process should be a planned system that allows feedback to be given in a formal—as opposed to informal—sense.</p>
    </div>

    <v-card-actions>
     
    </v-card-actions>
  </v-card>
  </div>
</template>

<script>
  export default {
    data: () => ({
      campus:'',
      campusid:'',
      start:'',
      end:'',
      timerCount: '',
      timerCount2: '',
      timerStatus:'',
      buttonDisable:null,
      hide:'text-black d-none',
      hidden:'d-none',
      timeHide:3,
    }),
    mounted(){
      this.mount()
      },
      methods:{
    
        mount(){
        const campus = window.location.search.substring(1).replace(/_/g,' ')
        const id = window.location.hash.substring(1)
   
        axios.post('/get_schedule',{
          campus:campus,
          campusid:id
        })
        .then(res=>{
          this.campus = campus.replace(/ /g,'_')
          this.campusid =id
          this.start = String(new Date(res.data.status[0].start+" 6:00:00 am").getTime())
           this.end = String(new Date(res.data.status[0].end+" 6:00:00 am").getTime())
          })
      },
    },
     watch: {
        timeHide:{
          handler(value){
             if (value > 0) {
                        setTimeout(() => {
                            this.timeHide--;
                        }, 1000);
                    }else{
                      this.hidden ='d-none'
                    }
          },
          immediate: true
        },
            timerCount: {
                handler(value) {

        function aaaa(n){
            return 1/(n*0)===1/0
        } 

            const now = new Date().getTime();
            const distance = this.start === ""?new Date() - now:this.start - now;
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);


                         
              const aaa = setTimeout(() => {
                    this.timerCount=days+"Days "+hours+"h "+minutes+"m "+seconds+"s";
              },1000);

          

                  
            if (aaaa(seconds) === false) {
              this.hide ="text-black"
              this.timerStatus = 'The evaluation will end in'
               this.timerCount='';
               this.buttonDisable=false
              clearInterval(aaa)
                   }else{
                    this.hide ="text-black d-none"
                    this.buttonDisable=true
                    this.timerStatus ='The evaluation will start in'
                   }

                },

                immediate: true // This ensures the watcher is triggered upon creation
            },
            timerCount2: {
                handler(value) {

        function aaaa(n){
            return 1/(n*0)===1/0
        } 

        const now = new Date().getTime();
        const distance2 = this.end === ""?new Date() - now:this.end - now;
        const distance1 = this.start === ""?new Date() - now:this.start - now;

        const days2 = Math.floor(distance2 / (1000 * 60 * 60 * 24));
        const hours2 = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes2 = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
        const seconds2 = Math.floor((distance2 % (1000 * 60)) / 1000);
                     
        
            const bbb = setTimeout(() => {
                    this.timerCount2=days2+"Days "+hours2+"h "+minutes2+"m "+seconds2+"s"

            },1000);
          
          if (aaaa(seconds2) === false) {
              this.buttonDisable=true
                clearInterval(bbb)
                this.timerStatus ='The Evaluation is not available!'
                 }
          
          
            

                },

                immediate: true // This ensures the watcher is triggered upon creation
            }

        }
  }
</script>