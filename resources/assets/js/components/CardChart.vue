<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row" style="min-height: 100px;" v-show="loading">
        <div class="col-md-12 text-center">
         <img class="loader" src="../../imgs/preloader.gif" />
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <card-liner-chart ref="chart" :styles="{height: canvasHeight,width: '100%', position: 'relative'}"  />
    </div>
  </div>
</template>
<script>
    export default{
      data(){
        return {
          rows: [],
          loading: false
        }
      },
      props: ['id','height','description'],
      created() {
        this.refresh();
      },
      methods: {
        refresh: function() {
            this.showLoader(true);
            axios.get('api/card/run/' + this.id)
            .then(response => {
                // Update Chart
                this.rows = response.data;
                this.$refs.chart.updateChart(this.chartData, this.description);

                this.showLoader(false);
                this.setError('');
            }).catch(error => {
                this.showLoader(false);
                this.setError(error);
            });
        },
        showLoader: function(loading){
          this.loading = loading;
        },
        setError: function(errorMessage){
          this.errorMessage = errorMessage;
        },
      },
      computed: {
        chartData: function () {
          return {
            labels: this.rows.map(function(x){
              return x[Object.keys(x)[0]];
            }),
            datasets: this.datasets
          };
        },
        canvasHeight: function() {
          return this.height + 'px';
        },
        datasets: function () {
            var data = [];
            for (var i = 1; i < Object.keys(this.rows[0]).length; i++) {
              data[i-1] ={
                label: Object.keys(this.rows[0])[i],
                backgroundColor: '#007bff',
                fill: false,
                data: this.rows.map(function(x){
                  return x[Object.keys(x)[i]];
                })
              };
            }
            return data;
        }
      }
    }
</script>
