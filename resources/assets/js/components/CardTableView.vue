<template>
   <div class="row" style="margin: 10px;">
     <div class="col-md-12">
       <div class="row" style="min-height: 100px;">
         <div class="col-md-12 text-center">
          <img class="loader" src="../../imgs/preloader.gif" v-show="loading" />
         </div>
       </div>
       <div class="row">
         <div class="col-md-12">
            <table class="table table-sm table-hover">
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
          axios.post('/api/run/query',{query:query})
          .then(response => {
                this.rows = response.data;
                this.showLoader(false);
                this.setError('');
          }).catch(error => {
                this.loading = false;
                this.errorMessage = error.response.data.error_message;
          });
      },
      save: function(card){
        this.showLoader(true);
        this.rows = [];
        axios.put('/api/save',{card:card})
        .then(response => {
              this.rows = response.data;
              this.showLoader(false);
              this.setError('');
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
</style>
