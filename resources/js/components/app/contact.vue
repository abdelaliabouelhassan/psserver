<template>
  <div class="card mt-5 px-4 py-5 bg-white">
    <h6 class="font-weight-bold">{{ $t("message.Send_us_message") }}</h6>
    <div class="mt-4">
      <div class="row">
        <div class="col-md-6">
          <span class="text-danger" v-if="errors.username">{{
            this.errors.username[0]
          }}</span>
          <input
            type="text"
            :class="{ 'is-invalid': errors.username }"
            class="form-control rounded my-2"
            v-model="form.username"
            :placeholder="$t('message.Username')"
          />
        </div>

        <div class="col-md-6">
          <span class="text-danger" v-if="errors.email">{{
            this.errors.email[0]
          }}</span>
          <input
            type="text"
            :class="{ 'is-invalid': errors.email }"
            class="form-control rounded my-2"
            v-model="form.email"
            :placeholder="$t('message.Email')"
          />
        </div>
      </div>
      <span class="text-danger" v-if="errors.message">{{
        this.errors.message[0]
      }}</span>
      <textarea
        name=""
        id=""
        cols="30"
        rows="5"
        class="form-control mt-2 rounded"
        :class="{ 'is-invalid': errors.message }"
        v-model="form.message"
        placeholder="I think"
      ></textarea>
      <input
        type="checkbox"
        v-model="tos"
        :class="{ 'is-invalid': etos }"
      /><label for="check" class="ml-2 my-2 terms"
        ><span :class="{ 'text-danger': etos }">{{
          $t("message.I_have_read")
        }}</span>
        <a href="" class="text-success font-16">Terms of Use</a></label
      >
      <vue-recaptcha
        ref="recaptcha"
        v-if="show"
        @verify="checkRecaptcha"
        :sitekey="$store.state.sitekey"
      ></vue-recaptcha>

      <input
        :disabled="clicked"
        type="submit"
        class="btn btn-dark d-block bg-dark mt-3"
        value="Contact Us"
        @click="ContactUs"
      />
    </div>
  </div>
</template>

<script>
import VueRecaptcha from "vue-recaptcha";
export default {
  components: { VueRecaptcha },
  data() {
    return {
      show: false,  
      form: {
        email: "",
        message: "",
        username: "",
        ReqResponse: "",
      },
      tos: false,
      errors: [],
      clicked: false,
      etos: false,
    };
  },
  created() {
       if(this.$route.path == '/contact'){
         something.$emit("hideSelect",false);
    }
    var vm = this;
    setTimeout(() => {
      vm.show = true;
    }, 1000);
  },
  methods: {
    checkRecaptcha(response) {
      this.form.ReqResponse = response;
      this.disabel = false;
    },
    ContactUs() {
      if (!this.tos) {
        this.etos = true;
        return;
      }
      this.clicked = true;
      this.etos = false;
      this.axios
        .post("/api/Contactus", this.form)
        .then((response) => {
          this.clicked = false;
          console.log(response);
          Toast.fire({
            icon: "success",
            title: this.$t("message.Message_Sent_Successfully"),
          });
        })
        .catch((errors) => {
          this.clicked = false;
          this.$refs.recaptcha.reset();
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
            Toast.fire({
              icon: "error",
              title: this.$t("message.Please_errors"),
            });
          } else if (errors.response.status == 403) {
            Toast.fire({
              icon: "error",
              title: errors.response.data,
            });
          } else {
            Toast.fire({
              icon: "error",
              title: this.$t("message.Something_went_wrong"),
            });
          }
        });
    },
  },
};
</script>

<style scoped>
</style>
