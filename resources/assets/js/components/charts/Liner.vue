<script>
import { Line } from 'vue-chartjs'
export default Line.extend({
  methods: {
    updateChart: function(data,text) {
      this.renderChart(data,{
            responsive: true,
            maintainAspectRatio: false,
            title: {
    					display: true,
    					text: text,
    				},
            legend: {
              labels: {
                usePointStyle: false
              }
            },
            scales: {
              xAxes: [{
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Month'
                  },
                  gridLines: {
                    display: true
                  }
              }],
              yAxes: [{
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Value'
                  },
                  ticks: {
                    beginAtZero:true
                  },
                  gridLines: {
                    display: true
                  }
              }]
            }
        });
    }
  }
});
</script>
