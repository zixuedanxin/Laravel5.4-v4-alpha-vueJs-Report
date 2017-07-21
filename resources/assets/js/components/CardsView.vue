<template>
  <div class="row">
    <div class="col-md-12">
         <img class="loader" src="imgs/preloader.gif" v-show="loading" />
    </div>
    <card v-for="card in cards" :card="card" v-on:card-deleted="cardDeleted"></card>
  </div>
</template>
<script>
    export default {
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
          },
          cardDeleted: function(card){
            this.cards= this.cards.filter(function(element) {
              return element.id !== card.id;
            });
          },
          cardAdded: function(card){
            this.cards.push(card);
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
