<template>
  <div class="text-center py-2">
    <h2 class="font-weight-bold" >{{$t('message.Create_Account')}}</h2>
    <p>
      {{$t('message.Already')}}<a
       style="cursor:pointer"
        class="ml-2 text-danger text-decoration-none"
        @click="login_modal"
        >{{$t('message.Sign_In')}}</a
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
            :placeholder="$t('message.Username')"
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
             :placeholder="$t('message.Email')"
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
            :placeholder="$t('message.Password')"
            name="password"
            v-model="form.password"
          />
          <span class="text-danger" v-if="errors.password">{{
            this.errors.password[0]
          }}</span>
          <input
            type="password"
            class="form-control my-3 rounded"
             :placeholder="$t('message.Confirm_Password')"
            name="confirmPassword"
            v-model="form.password_confirmation"
          />
          <div class="text-left">
            <input type="checkbox" v-model="tos" /><label for="check" class="ml-2"  :class="{ 'text-danger': errorTos }"
              ><span> {{$t('message.I_have_read')}}</span>
              <a href="javascript:void(0)" class="text-success font-16" 
                >{{$t('message.Terms_of_Use')}}</a
              ></label
            >
          </div>
          <vue-recaptcha @verify="checkRecaptcha" :sitekey="$store.state.sitekey"></vue-recaptcha>
          <input
            :disabled="disabel"
            type="submit"
            @click="register"
            class="btn btn-dark btn-block rounded"
            :value="$t('message.Sign_Up')"
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
        tos:false,
      form: {
        username: "",
        password: "",
        email: "",
        password_confirmation: "",
        ReqResponse:'',
      },
      errors: [],
      errorTos:false,
    };
  },
  methods: {
     checkRecaptcha(response){
         this.form.ReqResponse = response
        this.disabel = false
    },
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
            title: $t('message.Account_created'),
          });
           this.$modal.hide('register')
           this.disabel = false;
           this.errorTos = false
        })
        .catch((errors) => {
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
          }
          else if(errors.response.status == 403){
               Toast.fire({
            icon: "error",
            title: errors.response.data,
          });
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
