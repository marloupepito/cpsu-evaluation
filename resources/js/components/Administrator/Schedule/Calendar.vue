<template>
	<div>
	  <div class="row">
        <div class="col-md-6 col-6">
	            <v-btn
	              variant="outlined"
	              size="large"
	              icon
	              color="green"
	              @click="$router.go(-1)"
	            >
	              <v-icon>mdi-arrow-left-bold</v-icon>
	            </v-btn>
	        </div>
	         <div class="col-md-6 col-6">
	             <div class="row">
                <div class="col-md-10">
                <h1 class="page-header"> <small><select v-model="semester" @change="changeSem" class="form-select">
                <option selected disabled>Please Select Semester</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
              </select></small></h1>
                </div>
                <div class="col-md-2">
                <a class="btn btn-md w-100 btn-danger text-white" @click="resetDate">RESET</a>
                </div>
              </div>
	        </div>
          <div class="col-md-12">
            <FullCalendar :options="calendarOptions"></FullCalendar>
          </div>
	    </div>
	</div>
</template>



<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'
import bootstrapPlugin from '@fullcalendar/bootstrap'
import axios from 'axios'

export default {
  components: {
    FullCalendar // make the <FullCalendar> tag available
  },
  data() {
    var date = new Date();
    var currentYear = date.getFullYear();
    var currentMonth = date.getMonth() + 1;
        currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;
    
    return {
      campus:'',
      campusid:'',
            semester:'',
      calendarOptions: {
      contentHeight: 410,
        plugins: [ dayGridPlugin, timeGridPlugin, interactionPlugin, listPlugin, bootstrapPlugin ],
        headerToolbar: {
          left: 'dayGridMonth,timeGridWeek,timeGridDay',
          center: 'title',
          right: 'prev,next today'
        },
        buttonText: {
          today:    'Today',
          month:    'Month',
          week:     'Week',
          day:      'Day'
        },
        
        initialView: 'dayGridMonth',
        editable: true,
        droppable: true,
        themeSystem: 'bootstrap',
        views: {
          timeGrid: {
            eventLimit: 6 // adjust to 6 only for timeGridWeek/timeGridDay
          }
        },
        events: [{
          title: 'Evaluation Schedule',
          start: '',
          end: '',
          color: 'green',
        }],
                    eventDrop:this.recordEvent,
                    eventResize:this.recordEvent,
        },
    }
  },
  mounted(){
     const campusid = window.location.search.substring(1)
      const campus =window.location.pathname.split('/')[3].replace(/_/g,' ')
      this.campus =campus
      this.campusid =campusid
    axios.post('/get_schedule',{
      campus:this.campus,
      campusid:this.campusid
      })
    .then(res=>{
      this.calendarOptions.events[0].start = res.data.status[0].start
      this.calendarOptions.events[0].end = res.data.status[0].end
      this.semester = res.data.status[0].semester
     
    })
  },
    methods: {
    changeSem(e){
       axios.put('/change_sem',{
        campus:this.campus,
      campusid:this.campusid,
        semester:e.target.value
        })
    .then(res=>{
      this.semester = res.data.status[0].semester
       this.$swal({
          icon: 'success',
          title: 'saved',
          showConfirmButton: false,
          timer: 1500
        })
    })
    },
        events (arg){
            console.log(arg)
        },
        resetDate(arg){
    var date = new Date();
        const a = date.getMonth() + 1
    const b = date.getDate();
        const year = date.getFullYear();
    const month = (a < 10) ? '0' + a : a;
    const day = (b < 10) ? '0' + b : b;
        const start = year+'-'+month+'-'+day
        const end = year+'-'+month+'-'+(day+2)
      axios.put('/update_schedule',{
           campus:this.campus,
      campusid:this.campusid,
            start:start,
            end:end
            })
      .then(res=>{
        this.$swal({
          icon: 'success',
          title: 'saved',
          showConfirmButton: false,
          timer: 1500
        })
        this.calendarOptions.events[0].start = res.data.status[0].start
        this.calendarOptions.events[0].end = res.data.status[0].end
      })
      .catch(err=>{

      })
        },
        recordEvent (arg){
        var date = new Date(arg.event._instance.range.start);
        const a = date.getMonth() + 1
    const b = date.getDate();
        const year = date.getFullYear();
    const month = (a < 10) ? '0' + a : a;
    const day = (b < 10) ? '0' + b : b;
        const start = year+'-'+month+'-'+day

        var date2 = new Date(arg.event._instance.range.end);
        const aa = date2.getMonth() + 1
    const bb = date2.getDate();
        const year2 = date2.getFullYear();
    const month2 = (aa < 10) ? '0' + aa : aa;
    const day2 = (bb < 10) ? '0' + bb : bb;
        const end = year2+'-'+month2+'-'+day2
          axios.put('/update_schedule',{
               campus:this.campus,
      campusid:this.campusid,
            start:start,
            end:end
            })
      .then(res=>{
        this.$swal({
          icon: 'success',
          title: 'saved',
          showConfirmButton: false,
          timer: 1500
        })
        this.calendarOptions.events[0].start = res.data.status[0].start
        this.calendarOptions.events[0].end = res.data.status[0].end
      })
      .catch(err=>{

      })

        },

   
    }
}
</script>

<style>
button.fc-dayGridMonth-button.btn.btn-primary.active,button.fc-timeGridWeek-button.btn.btn-primary,button.fc-timeGridDay-button.btn.btn-primary{
display:none !important;
}
</style>