<template>
    <div class="card card-white w-100" id="card-view">
      <div class="card-body">
          <h3 class="card-title"><input class="form-control"  type="text" v-model="card.title" :disabled="edit != true || loading == true"/></h3>
          <p class="card-text"><input class="form-control"  type="text" v-model="card.description" :disabled="edit != true || loading == true"/></p>
          <a class="btn btn-outline-warning" :href="'cards/' + card.id" v-show="show">View</a>
          <button class="btn btn-outline-warning" v-show="edit == true" @click="saveCard">Save</button>
          <button class="btn btn-outline-danger" @click="deleteCard">delete</button>
          <img class="loader" src="../../imgs/preloader.gif" v-show="loading" />
      </div>
      <div class="card-footer">
        <b>{{ card.user.name }}</b>  <small>{{ card.created_at }}</small>
      </div>
    </div>
</template>

<script>
    export default {
        data(){
          return {
            loading: false,
            errorMessage: ''
          };
        },
        props: ['card','show','edit'],
        methods: {
           deleteCard: function () {
             axios.delete('/api/card/'+this.card.id)
               .then(response => {
                   this.$emit('card-deleted',this.card);
               });
           },
           saveCard: function () {
               this.showLoader(true);
               this.rows = [];
               axios.put('/api/save',{card:this.card})
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
        },
        created: function(){
            //console.log(this.card);
        }
    }
</script>
<style>
  #card-view .loader{
    width: 30px;
    height: 30px;
  }
</style>
