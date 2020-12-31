<template>
  <div class="text-center py-2">
    <h2 class="font-weight-bold" >Create Account</h2>
    <p>
      Already have an account?<a
       style="cursor:pointer"
        class="ml-2 text-danger text-decoration-none"
        @click="login_modal"
        >Sign In</a
      >
    </p>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <div class="mt-4">
          <input
            type="text"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors.username }"
            placeholder="Username"
            name="username"
            v-model="form.username"
          />
          <span class="text-danger" v-if="errors.username">{{
            this.errors.username[0]
          }}</span>
          <input
            type="email"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors.email }"
            placeholder="E-mail Address"
            name="email"
            v-model="form.email"
          />
          <span class="text-danger" v-if="errors.email">{{
            this.errors.email[0]
          }}</span>
          <input
            type="password"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors.password }"
            placeholder="Password"
            name="password"
            v-model="form.password"
          />
          <span class="text-danger" v-if="errors.password">{{
            this.errors.password[0]
          }}</span>
          <input
            type="password"
            class="form-control my-3 rounded"
            placeholder="Confirm Password"
            name="confirmPassword"
            v-model="form.password_confirmation"
          />
          <div class="text-left">
            <input type="checkbox" v-model="tos" /><label for="check" class="ml-2"  :class="{ 'text-danger': errorTos }"
              ><span>I have read and agree to the</span>
              <a href="javascript:void(0)" class="text-success font-16" 
                >Terms of Use</a
              ></label
            >
          </div>
          <input
            :disabled="disabel"
            type="submit"
            @click="register"
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
export default {
  data() {
    return {
        disabel:false,
        tos:false,
      form: {
        username: "",
        password: "",
        email: "",
        password_confirmation: "",
      },
      errors: [],
      errorTos:false,
    };
  },
  methods: {
    register() {

    if(!this.tos){
            this.errorTos = true
            return;
    }

     this.disabel = true;
      this.axios
        .post("/api/register", this.form)
        .then((response) => {
          this.errors = [];
        
          Toast.fire({
            icon: "success",
            title: "Account created successfully .  <b>  you need to login now</b>",
          });
           this.$modal.hide('register')
           this.disabel = false;
           this.errorTos = false
        })
        .catch((errors) => {
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
          }

           this.disabel = false;
        });
    },
    login_modal(){
       this.$modal.hide('register')
        this.$modal.show('login')
    }
  },
};
</script>

<style scoped>
</style>
