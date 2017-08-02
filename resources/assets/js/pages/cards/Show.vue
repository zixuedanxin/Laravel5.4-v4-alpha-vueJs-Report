<template>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-12">
          <card :card="card" :show="false" :edit="true" v-on:card-deleted="cardDeleted"></card>
        </div>
      </div>
      <div class="form-group row">
        <label for="query-input" class="col-1 col-form-label"><b></b></label>
        <div class="col-12">
          <textarea name="query" v-model="card.query" class="form-control alert alert-warning" type="text" value="" rows="4" cols="80" id="query-input"></textarea>
        </div>
      </div>
      <div class="row">
        <div class="col-9">
        </div>
        <div class="col-1 text-right">
          <button class="btn btn-outline-warning" @click="cardRun" >Run</button>
        </div>
        <div class="col-2 text-right">
          <button class="btn btn-outline-primary" @click="cardSave">Run and Save</button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <card-table-view ref="cardTableView" :query="card.query" ></card-table-view>
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
              this.$refs.cardTableView.run(this.card.query);
          },
          cardSave(){
              this.$refs.cardTableView.save(this.card);
          }
        }
    }
</script>
