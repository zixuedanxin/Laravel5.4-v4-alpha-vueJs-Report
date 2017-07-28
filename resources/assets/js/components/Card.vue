<template>
    <div class="card card-white w-100">
      <div class="card-block">
          <h3 class="card-title">{{ card.title }}</h3>
          <p class="card-text">{{ card.description }}</p>
          <a class="btn btn-outline-warning" :href="'cards/' + card.id" v-show="show">View</a>
          <button class="btn btn-outline-danger" @click="deleteCard">delete</button>
          <button class="btn btn-outline-primary">Export</button>
      </div>
      <div class="card-footer">
        <b>{{ card.user.name }}</b>  <small>{{ card.created_at }}</small>
      </div>
    </div>
</template>

<script>
    export default {
        props: ['card','show'],
        methods: {
           deleteCard: function () {
             axios.delete('/api/card/'+this.card.id)
               .then(response => {
                   this.$emit('card-deleted',this.card);
               });
           }
        },
        created: function(){
            //console.log(this.card);
        }
    }
</script>
