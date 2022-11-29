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
      default: '280'
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
               	label: 'Number of Student',
                backgroundColor: 'green',
                data: [] 
                },
                { 
                label: 'Number of Faculty',
                backgroundColor: 'yellow',
                data: [] 
                },
                { 
                label: 'Active Evaluator',
                backgroundColor: 'blue',
                data: [] 
                },
                { 
                label: 'Not Active Evaluator',
                backgroundColor: 'red',
                data: [] 
                }
            ]
      },
      chartOptions: {
        responsive: true
      }
    }
  },
  mounted(){

      axios.post('/get_all_users2')
        .then(res=>{
          this.chartData.labels = res.data.status.map(res =>res.campus)
             res.data.status.map(result => 
               axios.post('/get_every_campuses',{
                campusid:result.id
                })
                .then(resss=>{
                    this.active.push(resss.data.active.map(result=>result.status).length+resss.data.active2.map(result=>result.status).length)
                    this.notactive.push(resss.data.notactive.map(result=>result.status).length+resss.data.notactive2.map(result=>result.status).length)
                      this.student.push(resss.data.student.map(result=>result.status).length)
                        this.faculty.push(resss.data.faculty.map(result=>result.status).length)
                  })
             )
        })

       this.chartData.datasets[0].data = this.student
       this.chartData.datasets[1].data = this.faculty
        this.chartData.datasets[2].data = this.active
       this.chartData.datasets[3].data = this.notactive
       

  }
}
</script>