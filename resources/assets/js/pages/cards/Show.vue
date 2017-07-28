<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <card :card="card" :show="false" v-on:card-deleted="cardDeleted"></card>
        </div>
      </div>
      <div class="form-group row">
        <label for="query-input" class="col-1 col-form-label"><b></b></label>
        <div class="col-12">
          <textarea name="query" class="form-control alert alert-warning" type="text" value="" rows="4" cols="80" id="query-input">{{card.query}}</textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-10">
        </div>
        <div class="col-2">
          <button class="btn btn-outline-warning" @click="cardRun">run</button>
          <button class="btn btn-outline-primary" @click="cardSave">save</button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <card-table-view :query="card.query" ></card-table-view>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
    export default{
        props:['card'],
        methods: {
          cardDeleted(){
              this.$emit('navigate-to-list');
          },
          cardRun(){
            //this.$refs.cardView.cardAdded(card);
          },
          cardSave(){

          }
        }
    }
</script>
