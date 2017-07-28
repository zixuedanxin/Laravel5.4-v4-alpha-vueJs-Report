<template>
   <div class="row" style="text-align: center;">
     <div class="col-md-12">
          <img class="loader" src="../../imgs/preloader.gif" v-show="loading" />
     </div>
     <div class="col-md-12">
        <table class="table table-sm ">
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
        rows: []
      }
    },
    props: ['query'],
    created() {
      this.getDate();
    },
    methods: {
      getDate: function() {
          this.loading = true;
          axios.post('/api/run/query',{query: this.query})
          .then(wait(3000))
          .then(response => {
                this.rows = response.data;
                this.loading = false;
                console.log(this.rows);
          });
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
