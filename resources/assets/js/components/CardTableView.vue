<template>
   <div class="row" style="margin-top: 10px;">
     <div class="col-md-12">
       <div class="row" style="min-height: 100px;" v-show="loading">
         <div class="col-md-12 text-center">
          <img class="loader" src="../../imgs/preloader.gif" />
         </div>
       </div>
       <div class="row">
         <div class="col-md-12" v-show="errorMessage !=''">
           <div class="alert alert-danger" role="alert">
              <strong>Oh snap!</strong> {{errorMessage}}
            </div>
         </div>
       </div>

        <div id="accordion" role="tablist" aria-multiselectable="true">
          <div class="card">
            <div class="card-header" role="tab" id="headingOne">
              <h5 class="mb-0">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Data Table
                </a>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
              <div class="card-block">
                <div class="row" id="card-table">
                  <div class="col-md-12">
                     <table class="table table-striped table-bordered" id="cardTableView" ref="cardTableView">
                        <thead>
                          <tr>
                            <th v-for="(column, index) in rows[0]">{{index}}</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="row in rows">
                            <td v-for="column in row">{{column}}</td>
                          </tr>
                        </tbody>
                     </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card" v-show="showChart" >
            <div class="card-header" role="tab" id="headingTwo">
              <h5 class="mb-0">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Chart
                </a>
              </h5>
            </div>
            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
              <div class="card-block">
                <card-liner-chart ref="chart"  />
              </div>
            </div>
          </div>
        </div>
     </div>
   </div>
</template>
<script>
  function wait(ms) {
     return function(x) {
       return new Promise(resolve => setTimeout(() => resolve(x), ms));
     };
  }
  export default{
    data(){
      return {
        loading: false,
        errorMessage: '',
        rows: []
      }
    },
    props: ['query'],
    created() {
      this.run(this.query);
    },
    computed: {
      chartData: function () {
        return {
          labels:this.rows.map(function(x){
            return x.chart_v;
          }),
          datasets: [
            {
              label: 'Chart',
              backgroundColor: '#3097d1',
              data: this.rows.map(function(x){
                return x.chart_h;
              })
            }
          ]
        };
      },
      showChart: function() {
        return this.rows.length !=0 && this.rows[0].chart_h !== undefined && this.rows[0].chart_v !== undefined;
      }
    },
    methods: {
      run: function(query) {
          this.showLoader(true);
          this.updatingTable();
          axios.post('/api/run/query',{query:query})
          .then(response => {
                this.rows = response.data;
                this.showLoader(false);
                this.setError('');
                this.updatedTable();
          }).catch(error => {
                this.loading = false;
                this.errorMessage = error.response.data.error_message;
          });
      },
      save: function(card){
        this.showLoader(true);
        this.updatingTable();
        axios.put('/api/save',{card:card})
        .then(response => {
              this.rows = response.data;
              this.showLoader(false);
              this.setError('');
              this.updatedTable();
        }).catch(error => {
              this.showLoader(false);
              this.setError(error.response.data.error_message);
        });
      },
      showLoader: function(loading){
        this.loading = loading;
      },
      setError: function(errorMessage){
        this.errorMessage = errorMessage;
      },
      updatingTable: function(){
        if (this.rows.length != 0) {
          this.row = [];
          $(this.$refs.cardTableView).dataTable().fnDestroy();
        }
      },
      updatedTable: function(){
        if (this.rows.length != 0) {
          var self = this;
          setTimeout(function(){
            $(self.$refs.cardTableView).DataTable({
              lengthChange: true,
              buttons: [ 'copy', 'excel', 'pdf']
            }
            ).buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
          }, 100);

          // Update Chart
          this.$refs.chart.updateChart(this.chartData);
        }
      }
    }
  }
</script>
<style>
  .loader{
    margin: 0 auto;
    width: 3rem;
    height: 3rem;
  }
  #card-table{
    padding: 20px;
    margin-top: 20px;
    margin-left: 0px;
    margin-right: 0px;
    border-radius: 5px;
  }
</style>
