<template>
  <div class="row">
    <div class="col-md-12">
         <img class="loader" src="../../../imgs/preloader.gif" v-show="loading" />
    </div>
    <div v-for="card in cards" class="col-md-12" style="margin-top:10px;">
          <card-chart-view :id="card.id" :description="card.description" :height="500"></card-chart-view>
    </div>
  </div>
</template>
<script>
    export default{
      data(){
        return {
          cards: [],
          loading: false
        }
      },
      created() {
        this.refresh();
      },
      methods: {
        refresh: function() {
            this.loading = true;
            axios.get('api/cards')
            .then(response => {
                  this.cards = response.data;
                  this.loading = false;
            });
        }
      }
    }
</script>
