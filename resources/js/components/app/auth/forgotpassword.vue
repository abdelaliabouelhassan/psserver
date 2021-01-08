<template>
  <div class="text-center py-2">
      <div v-if="step == 1">
    <h2 class="font-weight-bold">Forgot Your Password? no worry </h2>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="mt-4">
              <span class="text-danger" v-if="errors.email">{{
            this.errors.email[0]
          }}</span>
          <input
            type="text"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors.email }"
            placeholder="Email"
            name="username"
            v-model="form.email"
          />
          <vue-recaptcha
            ref="recaptcha"
            @verify="checkRecaptcha"
            :sitekey="$store.state.sitekey"
          ></vue-recaptcha>

          <input
            :disabled="disabel"
            type="submit"
            @click="SendEmail"
            class="btn btn-dark btn-block rounded"
            :value="Enter"
          />

      </div>
      <div class="col-2"></div>
    </div>
  </div>
      </div>

 <div v-if="step == 2">
  <h2 class="font-weight-bold">Enter The Code We Sent You</h2>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="mt-4">
            <span class="text-danger" v-if="errors.code">{{
            this.errors.code[0]
          }}</span>
          <input
            type="text"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors.code }"
            placeholder="code "
            name="code"
            v-model="form.code"
          />
          <vue-recaptcha
            ref="recaptcha"
            @verify="checkRecaptcha"
            :sitekey="$store.state.sitekey"
          ></vue-recaptcha>

          <input
            :disabled="disabel"
            type="submit"
            @click="CheckCode"
            class="btn btn-dark btn-block rounded"
            :value="Enter"
          />

      </div>
      <div class="col-2"></div>
      </div>

   </div>
 </div>

  <div v-if="step == 3">
  <h2 class="font-weight-bold">Change Your Password</h2>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="mt-4">
            <span class="text-danger" v-if="errors.password">{{
            this.errors.password[0]
          }}</span>
          <input
            type="password"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors.password }"
            placeholder="Password "
            name="password"
            v-model="form.password"
          />
          <vue-recaptcha
            ref="recaptcha"
            @verify="checkRecaptcha"
            :sitekey="$store.state.sitekey"
          ></vue-recaptcha>

          <input
            :disabled="disabel"
            type="submit"
            @click="changePassword"
            class="btn btn-dark btn-block rounded"
            :value="Enter"
          />

      </div>
      <div class="col-2"></div>
      </div>

   </div>
 </div>
  </div>
</template>

<script>
import VueRecaptcha from "vue-recaptcha";

export default {
  components: { VueRecaptcha },
  data() {
    return {
        step:1,
      disabel: false,
      form: {
        email: "",
        password: "",
        code:'',
        ReqResponse:''
      },
      errors: "",
    };
  },
  methods: {
      changePassword(){
            this.disabel = true;
      this.axios
        .post("/api/changepassword", this.form)
        .then((response) => {
          this.errors = [];
          this.disabel = false;   
          this.step = 1; 
           this.$modal.hide("forgotpassword");
          this.$modal.show("login");
        })
        .catch((errors) => {
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
          } else if (errors.response.status == 403) {
            Toast.fire({
              icon: "error",
              title: errors.response.data,
            });
          }
          this.$refs.recaptcha.reset();
          this.disabel = false;
        });
      },
    checkRecaptcha(response) {
      this.form.ReqResponse = response;
      this.disabel = false;
    },
    CheckCode(){
   this.disabel = true;
      this.axios
        .post("/api/checkCode", this.form)
        .then((response) => {
          this.errors = [];
          this.disabel = false;   
          this.step = 3; 
        })
        .catch((errors) => {
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
          } else if (errors.response.status == 403) {
            Toast.fire({
              icon: "error",
              title: errors.response.data,
            });
          }
          this.$refs.recaptcha.reset();
          this.disabel = false;
        });
    },
    SendEmail(){
             this.disabel = true;
      this.axios
        .post("/api/forgotpassword", this.form)
        .then((response) => {
          this.errors = [];
          this.disabel = false; 
          Toast.fire({
            icon: "success",
            title: 'email sent Successfully',
          });    
          this.step = 2; 
        })
        .catch((errors) => {
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
          } else if (errors.response.status == 403) {
            Toast.fire({
              icon: "error",
              title: errors.response.data,
            });
          }
          this.$refs.recaptcha.reset();
          this.disabel = false;
        });
    }
  

  },
};
</script>

<style scoped>
</style>
