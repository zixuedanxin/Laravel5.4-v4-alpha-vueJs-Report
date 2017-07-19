<template lang="html">
  <div>
    <div class="row">
      <div class="col-md-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCardModel">
          Add card
        </button>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" ref="addCardModel" id="addCardModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new card</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label for="title-input" class="col-3 col-form-label">Title</label>
                  <div class="col-9">
                    <input class="form-control" v-model='card.title' :disabled='loading' type="text" value="" id="title-input">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <label for="description-input" class="col-3 col-form-label">Description</label>
                  <div class="col-9">
                    <input class="form-control" v-model='card.description' :disabled='loading' type="text" value="" id="description-input">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <img class="loader" src="imgs/preloader.gif" v-show="loading" />
            <button type="button" class="btn btn-secondary" @click="closeAddCard">Close</button>
            <button type="button" class="btn btn-primary" v-if="!loading" @click="saveCard">Save</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End of Modal -->
  </div>
</template>
<script>
    export default {
        data(){
          return {
            loading: false,
            card: {
              title: '',
              description: ''
            }
          };
        },
        methods: {
          saveCard(){
            // show loader
            this.loading = true;

            axios.post('api/card',{card: this.card})
                          .then(response => {
                          // clear inputs
                          this.card.title = '';
                          this.card.description = '';
                          //
                          this.loading = false;
                          //
                          $(this.$refs.addCardModel).modal('hide');
                          this.$emit('card-added', response.data);
            });
          },
          closeAddCard(){
            // show loader
            this.loading = false;
            $(this.$refs.addCardModel).modal('hide');
          },
          doSomethingOnHidden(){
            // cancel loader
            this.loading = false;

          }
        },
        mounted(){
          $(this.$refs.addCardModel).on("hidden.bs.modal", this.doSomethingOnHidden);
        }
    }
</script>
<style>
  #addCardModel .loader{
    width: 50px;
    height: 50px;
  }
</style>
