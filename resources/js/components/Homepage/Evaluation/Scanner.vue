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
     this.campus = window.location.pathname.replace(/_/g,' ').split('/')[2]
     this.campusid = window.location.search.substring(1)

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

        this.$swal({
        title: 'Loading...',
        allowOutsideClick: false,
        timerProgressBar: true,
        didOpen: () => {
          this.$swal.showLoading()
              const b = this.$swal.getHtmlContainer().querySelector('b')
            },
          })
        .then((result) => {
        if (result.dismiss === this.$swal.DismissReason.timer) {
        }
      })


        this.show = false
        this.pause()
      const a = content.split(",");
      this.type=a[0];
      const credentials = {
        evaluator:a[0],
        evaluatorid:a[1],
        password:a[2],
        campus:this.campus,
        campusid:this.campusid,
      }
     this.verify = false
     axios.post('/qrscanner',credentials)
     .then(res=>{
      this.show = true
      console.log(res.data.status)
        if(res.data.status === 'proceed'){
          this.unpause()
            this.$swal({
            icon: 'success',
            title: 'Success!',
            showConfirmButton: false,
            timer: 1500
          })
          this.$router.push({path:'/evaluation/form',query:{data:[this.type+','+this.campus.replace(/ /g,'_')+','+String(this.campusid)]}})
        }else if(res.data.status === 'continue'){
          this.unpause()
            this.$swal({
            icon: 'success',
            title: 'Continue!',
            showConfirmButton: false,
            timer: 1500
          })
          
          this.$router.push({path:'/evaluation/form',query:{data:[this.type+','+this.campus.replace(/ /g,'_')+','+String(this.campusid)]}})
        }else if(res.data.status === 'done'){
          this.unpause()
              this.$swal({
              icon: 'warning',
              title: 'Evaluation Done!',
              showConfirmButton: false,
              timer: 1500
            })
        }else if(res.data.status === 'No Subject Found!'){
          this.unpause()
            this.$swal({
            icon: 'error',
            title: res.data.status,
            showConfirmButton: false,
            timer: 1500
          })
        }else{
          this.unpause()
            this.$swal({
            icon: 'error',
            title: res.data.status,
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
      .catch(err=>{
            this.show = true
            this.unpause()
            this.$swal({
            icon: 'error',
            title: 'Incorrect QR code!',
            showConfirmButton: false,
            timer: 1500
          })
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
