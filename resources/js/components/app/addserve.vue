<template>
  <div class="card mt-5 px-4 py-5 bg-white">
    <div v-if="!this.$store.state.islogin" class="alert alert-dark" role="alert">
      You need to login in first then you can create a new server !.
      <a href="javascript:void(0)" v-on:click="login_modal"> click to login </a>
    </div>
    <div
      v-if="this.$store.state.user.email_verified_at == null && this.$store.state.islogin"
      class="alert alert-dark"
      role="alert"
    >
      You need to verify your email first then you can create a new server !.
       <a href="javascript:void(0)" v-show="emailVrf" v-on:click="SendEmailVerfication">click to send another verification email </a>
    </div>

    <h6 class="font-weight-bold">Create New Server</h6>
    <div class="mt-4">
      <div class="row">
        <div class="col-md-12">
          <label for="pageurl">Page URL :</label>
          <input
            type="url"
            id="pageurl"
            class="form-control rounded my-2"
            placeholder="Page URL"
          />
        </div>
        <div class="col-md-12">
          <label for="title">Server title :</label>
          <input
            type="text"
            id="title"
            class="form-control rounded my-2"
            placeholder="Server title "
          />
        </div>
        <div class="col-md-12">
          <label for="Banner">Banner :</label>
          <input
            type="file"
            id="Banner"
            class="form-control rounded my-2"
            placeholder="Banner "
          />
        </div>
        <div class="col-md-12">
          <label for="Category">Category :</label>
          <select id="Category" class="form-control rounded my-2">
            <option value="Oldschool Root">Oldschool Root</option>
            <option value="Oldschool Root">Oldschool Root</option>
            <option value="NewSchool Root">NewSchool Root</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="Language">Language :</label>
          <select
            class="form-control rounded my-2"
            id="Language"
            multiple
            data-live-search="true"
          >
            <option value="Deutsch">Deutsch</option>
            <option value="English">English</option>
            <option value="Espanol">Espanol</option>
            <option value="France">France</option>
            <option value="Roman">Roman</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="max">Max. Level :</label>
          <input
            type="number"
            id="max"
            step="any"
            class="form-control rounded my-2"
            placeholder="Max. Level "
          />
        </div>

        <div class="col-md-12">
          <label for="youtube">YouTube Trailer ID :</label>
          <input
            type="url"
            step="any"
            id="youtube"
            class="form-control rounded my-2"
            placeholder="YouTube Trailer ID "
          />
        </div>
        <div class="col-md-12">
          <label for="Rates">Rates (%) :</label>
          <input
            type="number"
            step="any"
            id="Rates"
            class="form-control rounded my-2"
            placeholder="Rates % "
          />
        </div>
      </div>
      <label for="Description">Description :</label>
      <textarea
        name=""
        id="Description"
        cols="30"
        rows="5"
        class="form-control mt-2 rounded"
        placeholder="Description"
      ></textarea>

      <input
        :disabled="checkuser"
        type="submit"
        class="btn btn-dark d-block bg-dark mt-3"
        value="Create"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        emailVrf:true,
    };
  },
  methods: {
      SendEmailVerfication(){
          this.emailVrf = false
            this.axios
        .post("/api/Verification", this.form)
        .then((response) => { 
            this.emailVrf = true     
           Toast.fire({
            icon: "success",
            title: "Verification email sent successfully",
          });     
        }) 
        .catch((errors) => {
            this.emailVrf = true
     Toast.fire({
            icon: "error",
            title: "Something went wrong please try again .",
          }); 
        });
      },
    login_modal() {
      something.$emit("login_modal");
    },
  },
  computed: {
    checkuser() {
      if (this.$store.state.islogin) {
        if (this.$store.state.user.email_verified_at != null) {
          return false;
        } else {
          return true;
        }
      } else {
        return true;
      }
    },
  },
};
</script>

<style scoped>
</style>
