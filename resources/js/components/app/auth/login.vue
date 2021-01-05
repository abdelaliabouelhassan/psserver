<template>
  <div class="text-center py-2">
    <h2 class="font-weight-bold">Welcome back!</h2>
    <p>
      Don't have an account?<a
        style="cursor:pointer"
        class="ml-2 text-success text-decoration-none"
         @click="register_modal"
        >Create Account</a
      >
    </p>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="mt-4">
          <span class="text-danger" v-if="errors">{{
            this.errors
          }}</span>
          <input
            type="text"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors }"
            placeholder="Username"
            name="username"
            v-model="form.username"
          />

          <input
            type="password"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors }"
            placeholder="Password"
            name="password"
            v-model="form.password"
          />

          <div class="text-left">
            <input type="checkbox" /><label for="check" class="ml-2"
              >Remember Me</label
            >
          </div>
            <vue-recaptcha @verify="checkRecaptcha" :sitekey="$store.state.sitekey"></vue-recaptcha>

          <input
           :disabled="disabel"
            type="submit"
            @click="login"
            class="btn btn-dark btn-block rounded"
            value="Sign In"
          />
        </div>
      </div>
      <div class="col-2"></div>
    </div>
  </div>
</template>

<script>
  import VueRecaptcha from 'vue-recaptcha';

export default {
      components: { VueRecaptcha },
  data() {
    return {
      disabel:false,
      form: {
        username: "",
        password: "",
        ReqResponse:'',
      },
      errors:"",
    };
  },
  methods: {
    checkRecaptcha(response){
      this.form.ReqResponse = response
        this.disabel = false
    },
    login() {
       this.disabel = true;
      this.axios
        .post("/api/login", this.form)
        .then((response) => {
          this.errors = [];
           this.disabel = false;
         something.$emit("loaduser");
           Toast.fire({
            icon: "success",
            title: "Signed in successfully",
          });
          this.$modal.hide('login')

          
        })
        .catch((errors) => {
       if (errors.response.status == 422) {
          this.errors = errors.response.data
       }else if(errors.response.status == 403){
           Toast.fire({
            icon: "error",
            title: errors.response.data,
          });
       }
         
         this.$store.state.islogin = false
           this.$store.state.user = []
            this.disabel = false;
        });
    },
     register_modal(){
       this.$modal.hide('login')
        this.$modal.show('register')
    }
  },
};
</script>

<style scoped>
</style>
