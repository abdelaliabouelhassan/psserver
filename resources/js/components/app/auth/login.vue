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
        <form @submit.prevent="login($event)" class="mt-4">
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

          <vue-recaptcha
            ref="recaptcha"
            @verify="onCaptchaVerified"
            @expired="resetCaptcha" 
             size="invisible"       
            sitekey="6LeCNhwaAAAAAHLVfJBdyleRSh7bRmYuvolBuycB">
        </vue-recaptcha>
          <input
           :disabled="disabel"
            type="submit"
           
            class="btn btn-dark btn-block rounded"
            value="Sign In"
          />
        </form>
      </div>
      <div class="col-2"></div>
    </div>
  </div>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha'
export default {
  components: {VueRecaptcha},
  data() {
    return {
        disabel:false,
         myForm: null,
      form: {
        username: "",
        password: "",
        recaptcha_response:"",
      },
      errors:"",
    };
  },
  methods: {
     onCaptchaVerified(token) {
            this.resetCaptcha()
             let fData = new FormData(this.myForm.target)
            fData.append('g-recaptcha-response', token)

      
           this.disabel = true;
      this.axios
        .post("/api/login", this.myForm)
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
    
          this.errors = errors.response.data
         this.$store.state.islogin = false
           this.$store.state.user = []
            this.disabel = false;
        });
        },
         resetCaptcha() {
            this.$refs.recaptcha.reset()
        },
 
    login() {
       this.myForm = event
             this.disabel = true
            this.$refs.recaptcha.execute()
    },
     register_modal(){
       this.$modal.hide('login')
        this.$modal.show('register')
    }
  },
};
</script>

<style scoped>
 .grecaptcha-badge {
        visibility: hidden !important;
    }
</style>
