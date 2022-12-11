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
        value:[]
      }
    },
  mounted(){
    this.mount()
    },
    methods:{
      changeSy(){
        
       axios.post('/get_school_year',{
        sy:this.value
        })
        .then(res=>{
            this.value= res.data.status;
            localStorage.setItem("get_school_year", res.data.status);
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
      
        const valueSy = localStorage.getItem("get_school_year") === null?academicYear[0]:localStorage.getItem("get_school_year");
       axios.post('/get_school_year',{
        sy:valueSy
        })
        .then(res=>{
          this.value= res.data.status;
          console.log(valueSy)
        })
      },
      
    }
}
</script>