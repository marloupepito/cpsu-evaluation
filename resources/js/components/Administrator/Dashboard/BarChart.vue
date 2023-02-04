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
      default: 400
    },
    height: {
      type: Number,
      default: '150'
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
      chartData: {
        labels: [],
        datasets: [
                 { 
                label: 'AVERAGE PER CAMPUS',
                backgroundColor: 'green',
                data: [300] 
                }
                
            ]
      },
      chartOptions: {
        responsive: true
      }
    }
  },
  async mounted(){

    await axios.post('/get_all_users2')
        .then(res=>{
          this.chartData.labels = res.data.status.map(res =>res.campus)
             res.data.status.map(result => 
               axios.post('/get_every_campuses',{
                campusid:result.id
                })
                .then(resss=>{
               //      this.notactive.push(resss.data.status.map(result=>result.status).length+resss.data.status.map(result=>result.status).length)

           this.notactive.push(resss.data.status.map(a=>parseFloat(a.total)).reduce((a, b) => a + b, 0)/resss.data.status.map(a=>parseFloat(a.total)).length)

                  })


             )
        })
      this.chartData.datasets[0].data = this.notactive


       

  }
}
</script>