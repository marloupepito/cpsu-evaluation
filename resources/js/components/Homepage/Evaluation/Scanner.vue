<template>
 <div>
    <qrcode-stream v-if="show === true" :camera="camera" @decode="onDecode" @init="onInit" style="height:100vh">
  
    </qrcode-stream>
  </div>
</template>


<script>
  import axios from 'axios'
export default {
  data () {
    return {
      camera: 'auto',
      result: null,
      showScanConfirmation: false,
      verify:false,
      type:'',
      campus:'',
      campusid:'',
      show:true
    }
  },
  mounted(){
    const type = window.location.search.substring(1).replace(/_/g,' ').split(',')[0]
     const campus = window.location.search.substring(1).replace(/_/g,' ').split(',')[1]
      const campusid = window.location.hash.substring(1)
      this.campus = campus
      this.campusid =campusid
      this.type =type
  },
  methods: {

   async  onInit (promise) {
      try {
         await promise
      } catch (e) {
        console.error(e)
      } finally {
       // this.showScanConfirmation = this.camera === "off"
      }
    },

      onDecode (content) {
        this.show = false
        this.pause()
      const a = content.split(",");
      const credentials = {
        evaluatorid:a[0],
        password:a[1],
        campus:this.campus,
        campusid:this.campusid,
        type:this.type,
      }
     this.verify = false
     axios.post('/qrscanner',credentials)
     .then(res=>{
        if(res.data.status === 'success'){
              this.$swal({
                icon: 'success',
                title: 'Success!',
                showConfirmButton: false,
                timer: 1500
              })
              this.show = true
              setTimeout(() => {
                //this.$router.push({path:'/evaluation/form?'+this.type+','+this.campus.replace(/ /g,'_')+'#'+this.campusid})
                  // window.location='/evaluation/form?'+this.type+','+this.campus.replace(/ /g,'_')+'#'+this.campusid
                   this.unpause()
              },1500);
        }else{
           // this.verify = true

           if(res.data.status === 'done'){
              this.unpause()
                this.$swal({
                icon: 'warning',
                title: 'Evaluation Done!',
                showConfirmButton: false,
                timer: 1500
              })
            }else{
              this.unpause()
                this.$swal({
                icon: 'error',
                title: 'No subject teacher available!',
                showConfirmButton: false,
                timer: 1500
              })
            }
            this.show = true
            
        }
      })
      .catch(err=>{
            this.unpause()
            this.$swal({
            icon: 'error',
            title: 'Incorrect QR code!',
            showConfirmButton: false,
            timer: 1500
          })
            this.show = true
        })


    },

    unpause () {
      this.camera = 'auto'
    },

    pause () {
      this.camera = 'off'
    },

    timeout (ms) {
      return new Promise(resolve => {
        window.setTimeout(resolve, ms)
      })
    }
  }
}
</script>
