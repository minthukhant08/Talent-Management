<template>
  <div class="small">
    <Doughnut :height="this.myheight" :chart-data="datacollection"></Doughnut>
    <button @click="fillData()">Randomize</button>
  </div>
</template>

<script>
  import Doughnut from './doughnut.js'

  export default {
    components: {
      Doughnut
    },
      props: {'data1':Array, 'myheight':Number},
    data () {
      return {
        datacollection: null
      }
    },
    created () {
      this.fillData()
    },
    methods: {
      fillData () {
        this.datacollection = {
          labels: this.data1,
          datasets: [
            {
              label: this.data1[0],
              backgroundColor: ['blue', 'red', 'orange', 'yellow'],
              data: [this.getRandomInt(), this.getRandomInt(),this.getRandomInt(), this.getRandomInt()]
            }
          ]
        }
      },
      getRandomInt () {
        return Math.floor(Math.random() * (50 - 5 + 1)) + 5
      }
    }
  }
</script>

<style>
  .small {
    /* max-width: 600px; */
    /* margin:  150px auto; */
    /* height: 100px; */
  }
</style>
