<template>
  <div style="width: 100%">
    <BarChart v-bind="doughnutChartProps" />
  </div>
</template>

<script lang='ts'>
import { computed, defineComponent, ref } from "vue";
import { shuffle } from "lodash";
import { BarChart, useDoughnutChart } from "vue-chart-3";
import { Chart, ChartData, ChartOptions, registerables } from "chart.js";

Chart.register(...registerables);
export default defineComponent({
  name: "App",
  components: { BarChart },
   data () {
      return {
        campuses:[],
      }
    },
    mounted(){
        axios.post('/get_all_users')
        .then(res=>{
         
          const aa = res.data.status.map(res =>res.campus)
          localStorage.setItem("campuses",Object.values(aa));
          console.log(localStorage.getItem("campuses").split(','))
        })
    },
  setup() {
    const dataValues = ref([ 40, 60, 70, 5,30, 40, 60, 70, 5]);
    const dataLabels = ref(localStorage.getItem("campuses").split(','));
    const toggleLegend = ref(true);

    const testData = computed<ChartData<"doughnut">>(() => ({
      labels: dataLabels.value,
      datasets: [
        {
          data: dataValues.value,
          backgroundColor: [
            "#33cc33",
            "#33cc33",
            "#33cc33",
            "#33cc33",
            "#33cc33",
          ],
        },
      ],
    }));

    const options = computed<ChartOptions<"doughnut">>(() => ({
      scales: {
        myScale: {
          type: "logarithmic",
          position: toggleLegend.value ? "left" : "right",
        },
      },
      plugins: {
        legend: {
          position: toggleLegend.value ? "top" : "bottom",
        },
        title: {
          display: true,
          text: "Total Campuses",
        },
      },
    }));

    const { doughnutChartProps, doughnutChartRef } = useDoughnutChart({
      chartData: testData,
      options,
    });

    let index = ref(20);

    function shuffleData() {
      // dataValues.value = shuffle(dataValues.value);
      dataValues.value.push(index.value);
      dataLabels.value.push("Other" + index.value);
      console.log(dataValues.value);
      console.log(doughnutChartRef.value.chartInstance);
      index.value++;
    }

    function switchLegend() {
      toggleLegend.value = !toggleLegend.value;
    }

    return {
      shuffleData,
      switchLegend,
      testData,
      options,
      doughnutChartRef,
      doughnutChartProps,
    };

  },
});
</script>


