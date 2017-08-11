<template>
   <div class="row" style="margin-top: 10px;">
     <div class="col-md-12">
       <div class="row" style="min-height: 100px;" v-show="loading">
         <div class="col-md-12 text-center">
          <img class="loader" src="../../imgs/preloader.gif" />
         </div>
       </div>
       <div class="row" id="card-table">
         <div class="col-md-12">
            <table class="table table-striped table-bordered" id="example">
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
       <div class="row">
         <div class="col-md-12" v-show="errorMessage !=''">
           <div class="alert alert-danger" role="alert">
              <strong>Oh snap!</strong> {{errorMessage}}
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
    methods: {
      run: function(query) {
          this.showLoader(true);
          this.rows = [];
          $('#example').DataTable().clear().destroy();
          axios.post('/api/run/query',{query:query})
          .then(response => {
                this.rows = response.data;
                this.showLoader(false);
                this.setError('');
                setTimeout(function(){
                  $('#example').DataTable({
                    lengthChange: false,
                    buttons: [ 'copy', 'excel', 'pdf']
                  }
                  ).buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
                }, 100);
          }).catch(error => {
                console.log('ARCHER: ERROR');
                this.loading = false;
                this.errorMessage = error.response.data.error_message;
          });
      },
      save: function(card){
        this.showLoader(true);
        this.rows = [];
        $('#example').DataTable().clear().destroy();
        axios.put('/api/save',{card:card})
        .then(response => {
              this.rows = response.data;
              this.showLoader(false);
              this.setError('');
              setTimeout(function(){
                $('#example').DataTable({
                  lengthChange: false,
                  buttons: [ 'copy', 'excel', 'pdf']
                }
                ).buttons().container().appendTo( '#example_wrapper .col-md-6:eq(0)' );
              }, 100);
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
    background: #fcf8e3;
    border: 1px #faf2cc solid;
    border-radius: 5px;
  }
</style>
