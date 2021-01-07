<template>
  <div>
    <modal name="login" :height="400"><login></login></modal>
    <modal name="register" :height="600"><register></register></modal>
    <modal name="admin" :height="200">
      <div class="my-3 px-4 py-5 bg-white">
        <h6 class="font-weight-bold">
          Welcome Back Do You Want To GO To Admin Panel ?
        </h6>
        <button class="btn btn-dark" @click="go_admin_panel">
          {{ $t("message.Yes") }}
        </button>
        <button class="btn btn-dark" @click="$modal.hide('admin')">
          {{ $t("message.No") }}
        </button>
      </div>
    </modal>

    <header_app></header_app>
    <banner></banner>
    <ad_app></ad_app>
    <main_app></main_app>
    <footer_app></footer_app>
  </div>
</template>

<script>
import register from "./app/auth/register.vue";
export default {
  components: { register },
  data() {
    return {};
  },
  methods: {
    go_admin_panel() {
      location.href = "/admin";
    },
    getLang() {
      this.axios
        .get("/api/getLang")
        .then((response) => {
          this.$store.state.lang = response.data;
          this.$i18n.locale = this.$store.state.lang;
        })
        .catch((errors) => {});
    },
    loadUser() {
      this.axios
        .get("/api/user")
        .then((response) => {
          this.$store.state.islogin = true;
          this.$store.state.user = response.data;
        })
        .catch((errors) => {
          this.$store.state.islogin = false;
          this.$store.state.user = [];
        });
    },
  },
  created() {
    this.getLang();
    this.loadUser();
    something.$on("loaduser", () => {
      this.loadUser();
    });
    something.$on("login_modal", () => {
      this.$modal.show("login");
    });
    something.$on("login_register", () => {
      this.$modal.show("register");
    });
  },
};
</script>

<style scoped>
</style>
