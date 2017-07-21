<template>
  <div class="col-md-6" style="margin-top:10px;">
    <div class="card card-white w-100">
      <div class="card-block">
          <h3 class="card-title">{{ card.title }}</h3>
          <p class="card-text">{{ card.description }}</p>
          <button class="btn btn-outline-danger" @click="deleteCard">delete</button>
          <button class="btn btn-outline-primary">Export</button>
      </div>
      <div class="card-footer">
        <b>{{ card.user.name }}</b>  <small>{{ card.created_at }}</small>
      </div>
    </div>
  </div>
</template>
<script>
    export default{
      data(){
        return {
          card: {
            title: '',
            description: '',
            id: 0,
            user: {
              name: ''
            },
            created_at: ''
          }
        };
      },
      props: ['id'],
      created: function(){
         axios.get('../api/card/'+this.id)
           .then(response => {
              this.card = response.data;
           });
       },
       methods: {
          deleteCard: function () {
            axios.delete('../api/card/'+this.card.id)
              .then(response => {
                  this.$emit('card-deleted',this.card);
              });
          }
       }
    }
</script>
