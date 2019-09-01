import { Radar } from 'vue-chartjs'

export default {
  extends: Radar,
  props:['chartData','options'],
  // methods: {
  //   update() {
  //     this.$data._chart.update()
  //   }
  // },
  mounted () {
    this.renderChart(this.chartData,{responsive: true, maintainAspectRatio: false})
  }
};
