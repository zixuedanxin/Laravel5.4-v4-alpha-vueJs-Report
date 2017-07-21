<template>
  <div>
    <add-card v-on:card-added="cardAdded"></add-card>
    </br>
    <card-view ref="cardView"></card-view>
  </div>
</template>
<script>
    export default{
        methods: {
          cardAdded(card){
            this.$refs.cardView.cardAdded(card);
          }
        }
    }
</script>
