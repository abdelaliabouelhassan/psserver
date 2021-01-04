<template>
  <div class="card mt-5 px-4 py-5 bg-white">
    <h6 class="font-weight-bold">Send us message</h6>
    <div  class="mt-4">
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
            placeholder="User Name"
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
            placeholder="E-mail address"
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
        ><span :class="{ 'text-danger': etos }"
          >I have read and agree to the</span
        >
        <a href="" class="text-success font-16">Terms of Use</a></label
      >
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
export default {
  data() {
    return {
      form: {
        email: "",
        message: "",
        username: "",
      },
      tos: false,
      errors: [],
      clicked: false,
      etos: false,
    };
  },
  methods: {
      
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
            title: "Message Sent Successfully",
          });
        })
        .catch((errors) => {
          this.clicked = false;
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
            Toast.fire({
              icon: "error",
              title: "Please check the error above .",
            });
          } else {
            Toast.fire({
              icon: "error",
              title: "Something went wrong please try again .",
            });
          }
        });
    },
  },
};
</script>

<style scoped>
</style>
