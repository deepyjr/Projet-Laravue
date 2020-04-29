<template>
  <CChartBar
    :datasets="defaultDatasets"
    :labels="days"
  />
</template>

<script>
import { CChartBar } from '@coreui/vue-chartjs'

export default {
  name: 'CChartBarExample',
  data () {
    return {
      clientId: 1,
      tableauData:[],
      days: ['Dimanche','Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi' , 'Samedi']
    }
  },

  components: { CChartBar },
  computed: {
    defaultDatasets () {
      return [
        {
          label: 'Déclenchement Jour par Jour',
          backgroundColor: '#3497DC',
          data: this.tableauData
        }
      ]
    }
  },
   mounted() {
    axios.get("/api/dashbord/getDataForDashbord/" + this.clientId).then(res => {
      this.tableauData = Object.values(res.data.nbWashWeek);
      
      console.log(this.tableauData);

      // for(let i = 0 ; i< this.dashboard.nbWashWeek.length(); i++){
      //    this.data.push(this.dashboard.nbWashWeek[i])
      // }

    });
  },
}
</script>
