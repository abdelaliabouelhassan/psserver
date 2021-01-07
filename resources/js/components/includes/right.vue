<template>
  <div class="col-md-4 my-1">
    <router-link
      to="/createserver"
      class="btn btn-danger btn-block rounded py-3 font-weight-bold"
      >{{ $t("message.ADD_YOUR_SERVER") }}</router-link
    >
    <div class="card firstCard py-5 mt-4" v-if="server">
      <div class="container">
        <p class="text-danger">{{ $t("message.FEATURED_SERVER") }}</p>
        <span class="d-inline m-auto">&raquo;</span>
        <h2 class="font-weight-bold text-white d-inline">{{ url }}</h2>
        <p class="mt-4 mb-3 text-white card-lorem">
          {{ server.short_description }}
        </p>
        <p>
          <span>
            <img src="/img/like.png" class="img-fluid" alt="" />
          </span>
          <span class="text-success">{{ server.realtimeVote }}</span>
          <span class="mx-3 text-secondary">|</span>
          <span>
            <i class="fa fa-external-link-alt text-white"></i>
          </span>
          <span class="text-white">{{ server.viewd }}</span>
        </p>
        <a
          @click="goDetails(server.slug)"
          class="btn btn-light mt-5 d-inline"
          >{{ $t("message.VISIT_WEBSITE") }}</a
        >
        <img src="/img/m2.png" class="img-fluid d-inline ml-4" alt="" />
      </div>
    </div>
    <div class="card card-two mt-3" v-if="server2">
      <img src="/img/add.png" class="card-img-top img-fluid" alt="" />
      <div class="card-body bg-dark">
        <div class="px-3">
          <p class="text-white">
            {{ server2.short_description }}
          </p>
          <div class="row mt-3">
            <div class="col-6">
              <img src="/img/eye.png" class="img-fluid" alt="" />
              <span class="vision">{{ server2.viewd }}</span>
            </div>
            <div class="col-6">
              <span class="vision">{{ server2.created_at }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card card-three mt-3 bg-dark py-3">
      <div class="container">
        <div class="text-center">
          <p class="text-white mb-3">
            {{ $t("message.Promoted_server_trailer") }}
          </p>
          <iframe
            width="100%"
            height="auto"
            src="https://www.youtube.com/embed/xcJtL7QggTI"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      server: [],
      server2: [],
      url: "",
    };
  },
  created() {
    this.get_server();
  },
  methods: {
    goDetails(slug) {
      this.$router.push({ path: `/serverdetails/${slug}` });
    },
    get_server() {
      this.axios
        .get("/api/GetFeathred_Server")
        .then((response) => {
          this.server = response.data.data[0];
          this.server2 = response.data.data[1];
          this.url = this.server.url.replace(/[http://www https://www]/g, "");
        })
        .catch((errors) => {});
    },
  },
};
</script>

<style scoped>
</style>
