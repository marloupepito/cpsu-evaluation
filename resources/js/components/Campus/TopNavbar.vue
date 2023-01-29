<template>
  <v-app-bar
       color="green"
       dark
       inverted-scroll
       app
       fixed="true"
     >
 
       <v-toolbar-title>Central Philippines State University</v-toolbar-title>
 
       <v-spacer></v-spacer>
 
       
       <v-select
            class="mt-5"
           v-model="sem"
           label="Select Semester"
           density="compact"
           :items="['1st Semester','2nd Semester']"
           @update:modelValue="changeSem"
         ></v-select>
 
 
        <v-select
            class="mt-5"
           v-model="value"
           label="Select Year"
           density="compact"
           :items="sy"
           @update:modelValue="changeSy"
         ></v-select>
   
        
 
       <v-btn icon  to="/logout">
         <v-icon>mdi-logout-variant</v-icon>
       </v-btn>
     </v-app-bar>
 </template>
 
 <script>
 export default{
    data () {
       return {
         sy:1,
         value:[],
         sem:[]
       }
     },
   mounted(){
     this.mount()
     },
     methods:{
       changeSem(){
         axios.post('/get_school_year',{
         sy:this.value,
         sem:this.sem
         })
         .then(res=>{
             this.value= res.data.status1;
             this.sem= res.data.status2;
             localStorage.setItem("get_school_year", res.data.status1);
             localStorage.setItem("get_sem", res.data.status2);
             location.reload()
         })
       },
       changeSy(){
         
        axios.post('/get_school_year',{
         sy:this.value,
         sem:this.sem
         })
         .then(res=>{
             this.value= res.data.status1;
             this.sem= res.data.status2;
             localStorage.setItem("get_school_year", res.data.status1);
             localStorage.setItem("get_sem", res.data.status2);
             location.reload()
         })
       },
       mount(){
         const a =new Date('2020').getFullYear();
         const b =new Date().getFullYear();
         const start_date = (b-a)+2;
         var year = new Date().getFullYear();
         var lastyear = new Date().getFullYear()+1;
         var range = [];
         var lastrange = [];
         var academicYear=[];
         lastrange.push(lastyear);
         range.push(year);
           for (var i = 1; i < start_date; i++) 
           {
             lastrange.push(lastyear - i);    
             range.push(year - i);
             academicYear.push('20'+(lastrange[i]).toString().slice(-2)+" - "+lastrange[i-1]);
             var fullyear = lastrange.concat(range);
            }
        this.sy =academicYear;
       const d = new Date();
       let month = d.getMonth() + 1;

       const sems = month === 1 || month === 2 || month === 3 || month === 4 || month === 5?'2nd Semester':'1st Semester'
       
         const valueSy = localStorage.getItem("get_school_year") === null?academicYear[0]:localStorage.getItem("get_school_year");
         const ValueSem = localStorage.getItem("get_sem") === null?sems:localStorage.getItem("get_sem");
           axios.post('/get_school_year',{
             sy:valueSy,
             sem:ValueSem
             })
             .then(res=>{
               this.value= res.data.status1;
               this.sem= res.data.status2;
             })
       },
       
     }
 }
 </script>