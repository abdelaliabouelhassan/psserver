<template>
  <div class="text-center py-2">
    <h2 class="font-weight-bold">{{ $t("message.Welcome_back") }}</h2>
    <p>
      {{ $t("message.account")
      }}<a
        style="cursor: pointer"
        class="ml-2 text-success text-decoration-none"
        @click="register_modal"
        >{{ $t("message.Create_Account") }}</a
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
          <input
            type="password"
            class="form-control my-3 rounded"
            :class="{ 'is-invalid': errors.password }"
            :placeholder="$t('message.Password')"
            name="password"
            v-model="form.password"
          />

          <div class="text-left">
            <input type="checkbox" /><label for="check" class="ml-2">{{
              $t("message.Remember_Me")
            }}</label>
          </div>

           <div class="text-left">
            <label
              for="check"
              class="ml-2"
              ><a href="javascript:void(0)" @click="forgotPassword"> Forgot Your Password ?</a> </label>
          </div>

          <vue-recaptcha
            ref="recaptcha"
            @verify="checkRecaptcha"
            :sitekey="$store.state.sitekey"
          ></vue-recaptcha>

          <input
            :disabled="disabel"
            type="submit"
            @click="login"
            class="btn btn-dark btn-block rounded"
            :value="$t('message.Sign_In')"
          />
        </div>
      </div>
      <div class="col-2"></div>
    </div>
  </div>
</template>

<script>
import VueRecaptcha from "vue-recaptcha";

export default {
  components: { VueRecaptcha },
  data() {
    return {
      disabel: false,
      form: {
        username: "",
        password: "",
        ReqResponse: "",
      },
      errors: "",
    };
  },
  methods: {
    forgotPassword(){
      this.$modal.hide("login");
      this.$modal.show("forgotpassword");
    },
    checkRecaptcha(response) {
      this.form.ReqResponse = response;
      this.disabel = false;
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
            title: this.$t("message.Signed_in_successfully"),
          });
          this.$modal.hide("login");

          if (response.data.is_admin) {
            this.$modal.show("admin");
          }
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
          this.$store.state.islogin = false;
          this.$store.state.user = [];
          this.disabel = false;
        });
    },
    register_modal() {
      this.$modal.hide("login");
      this.$modal.show("register");
    },
  },
};
</script>

<style scoped>
</style>
