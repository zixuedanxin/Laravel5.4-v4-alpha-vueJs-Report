<script>
import { Line } from 'vue-chartjs'
export default Line.extend({
  methods: {
    updateChart: function(data,text) {
      this.renderChart(data,{responsive: true,maintainAspectRatio: false, title: {
					display: true,
					text: text,
				}});
    }
  }
});
</script>
