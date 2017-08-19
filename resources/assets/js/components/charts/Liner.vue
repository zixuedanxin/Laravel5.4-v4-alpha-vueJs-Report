<script>
import { Bar } from 'vue-chartjs'
export default Bar.extend({
  methods: {
    updateChart: function(data) {
      this.renderChart(data);
    }
  }
});
</script>
