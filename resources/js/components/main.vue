<template>
  <div>
       <modal name="login"  :height="400" ><login></login></modal>
       <modal name="register"    :height="600"><register></register></modal>
    <header_app></header_app>
    <banner></banner>
    <ad_app></ad_app>
    <main_app></main_app>
    <footer_app></footer_app>
  </div>
</template>

<script>
import register from './app/auth/register.vue';
export default {
  components: { register },
  data() {
    return {};
  },
  methods: {
    getLang(){
      this.axios
        .get("/api/getLang")
        .then((response) => {
        this.$store.state.lang =  response.data;
        this.$i18n.locale = this.$store.state.lang
        })
        .catch((errors) => {
        });
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
      this.$modal.show('login')
    });
     something.$on("login_register", () => {
      this.$modal.show('register')
    });
  },
};
</script>

<style scoped>
</style>
