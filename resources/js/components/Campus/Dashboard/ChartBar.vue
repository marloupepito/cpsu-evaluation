<template>
  <div>
 
  <Bar
    :chart-options="chartOptions"
    :chart-data="chartData"
    :chart-id="chartId"
    :dataset-id-key="datasetIdKey"
    :plugins="plugins"
    :css-classes="cssClasses"
    :styles="styles"
    :width="width"
    :height="height"
  />
   </div>
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
  name: 'BarChart',
  components: { Bar },
  props: {
    chartId: {
      type: String,
      default: 'bar-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: '100%'
    },
    height: {
      type: Number,
      default: '350'
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => {}
    },
    plugins: {
      type: Object,
      default: () => {}
    }
  },

  data() {
    return {
      data:[],
      active:[],
      notactive:[],
      faculty:[],
      student:[],
      a:'',
      b:'',
      c:'',
      d:'',
      e:'',
      chartData: {
        labels: [ 'College of Computer Study', 'College of Business Management', 'College of Teachers Education', 'College of Agriculture and Forestry','College of Criminal Justice Education' ],
        datasets: [
                 { 
               	label: 'AVERAGE PER DEPARTMENT',
                backgroundColor: 'green',
                data: [] 
                },
            ]
      },
      chartOptions: {
        responsive: true
      }
    }
  },
  mounted(){
         const campus = localStorage.getItem("campus");
       const campusid = localStorage.getItem("campusid");
    axios.post('/counting_data',{
      campus:campus,
      campusid:campusid
    })
    .then(res=>{


      console.log('ss',res.data.a.map(a=>parseFloat(a.total)).reduce((a, b) => a + b, 0)/res.data.a.map(a=>parseFloat(a.total)).length)
      this.chartData.datasets[0].data = [
res.data.a.map(a=>parseFloat(a.total)).reduce((a, b) => a + b, 0)/res.data.a.map(a=>parseFloat(a.total)).length
,
res.data.b.map(a=>parseFloat(a.total)).reduce((a, b) => a + b, 0)/res.data.b.map(a=>parseFloat(a.total)).length
,
res.data.c.map(a=>parseFloat(a.total)).reduce((a, b) => a + b, 0)/res.data.c.map(a=>parseFloat(a.total)).length
,
res.data.d.map(a=>parseFloat(a.total)).reduce((a, b) => a + b, 0)/res.data.d.map(a=>parseFloat(a.total)).length
,
res.data.e.map(a=>parseFloat(a.total)).reduce((a, b) => a + b, 0)/res.data.e.map(a=>parseFloat(a.total)).length
]

      })
       

  }
}
</script>