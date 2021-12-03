<template>
  <div>
    <div class="row">
      <div class="col-md-12 text-center">
        <h3>Comment Section</h3>
      </div>


          <div v-if="user" class="col-md-10">
            <textarea class="form-control" v-model="comment" rows="4"></textarea>
          </div>
          <div v-if="user" class="col-md-2">
            <button @click="addcomment()" class="btn_3 align my-4">Comment</button>
          </div>



      <div class="col-md-12 my-2" v-for="(c, index) in comments.comments" :key="index">
        <div class="card">
          <div class="card-header">
            Comment by {{ c.user.name }} at
            {{ moment(c.created_at).format("DD-MM-YYYY h:mm a") }}
          </div>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">
              {{ c.comment }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props: ["user", "product"],
  data: function () {
    return {
      comment: "",
      comments: [],
      moment: moment,
    };
  },

  methods: {
    addcomment() {
      axios
        .post("/comment/store", {
          comment: this.comment,
          user_id: this.user.id,
          product_id: this.product,
        })
        .then((response) => {
          if (response.status == 200) {
            this.comment = "";
            this.getCommentList();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCommentList() {
      axios
        .get("/comments?product_id =" + this.product)
        .then((response) => {
          this.comments = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getCommentList();
  },
};
</script>

<style scoped>
.align {
  align-items: center;
  align-content: center;
}
</style>
