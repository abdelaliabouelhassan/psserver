<template>
  <section class="main">
    <div class="container" style="max-width: 68% !important">
      <div class="row">
        <div class="col-md-8 my-1">
          <div class="row">
            <div class="col-sm-8">
              <h6 class="font-weight-bold">{{ $t("message.Welcome") }}</h6>
              <p>{{ $t("message.Largest_private_server_list") }}</p>
            </div>
            <div class="col-sm-4 text-right" v-show="show">
              <div class="input-group">
                <select
                  v-model="server"
                  name=""
                  id=""
                  class="form-control d-inline mx-2"
                >
                  <option value="">{{ $t("message.All_Servers") }}</option>
                  <option value="English">English</option>
                  <option value="Espanol">Espanol</option>
                  <option value="Roman">Roman</option>
                  <option value="German">German</option>
                  <option value="Turkish">Turkish</option>
                   <option value="Portuguese">Portuguese</option>
                    <option value="Hungarian">Hungarian</option>
                     <option value="Greek">Greek</option>
                </select>

                <div class="input-group-append">
                  <button class="btn btn-dark" @click="search">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <router-view></router-view>
        </div>
        <right></right>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  methods: {
    search() {
      something.$emit("search", this.server);
      if (this.$route.path != "/") {
        this.$router.push({ path: "/" });
      }
    },
  },
  created(){
    something.$on('hideSelect',(value)=>{
      this.show = value;
    })
  },

  data() {
    return {
      server: "",
      show:true,
    };
  },
};
</script>

<style scoped>
</style>
