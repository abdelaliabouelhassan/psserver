<template>
  <div>
    <modal name="warm" :height="200">
      <div class="my-3 px-4 py-5 bg-white">
        <h6 class="font-weight-bold">{{ $t("message.server_is_inactive") }}</h6>
        <button class="btn btn-dark" @click="visit">
          {{ $t("message.Yes") }}
        </button>
        <button class="btn btn-dark" @click="$modal.hide('warm')">
          {{ $t("message.No") }}
        </button>
      </div>
    </modal>

    <div
      v-if="Servers.length == 0"
      style="text-align: center; margin-top: 100px"
    >
      <b>{{ $t("message.No_Records_Found") }} </b>
    </div>

    <div
      class="card serverCard p-4 mb-3 mt-5"
      v-for="(Server, index) in Servers"
    >
      <img
        src="/img/flags.png"
        class="img-fluid flag-img"
        alt="international server"
        v-if="Server.is_international"
      />
      <div class="row">
        <div class="col-sm-5">
          <div class="row">
            <div class="col-2">
              <img src="/img/down.png" alt="down" v-if="Server.upDown == 0" />
              <img src="/img/up.png" alt="up" v-if="Server.upDown == 2" />
              <span style="margin-left: 10px" v-if="Server.upDown == 1">
                <i class="fas fa-pause 3x"></i
              ></span>
            </div>

            <div class="col-10 m-auto">
              <div class="row">
                <div class="col-3">
                  <h5
                    class="d-inline-block px-3 py-2 rounded text-white"
                    style="cursor: pointer"
                    @click="goDetails(Server.slug, index)"
                  >
                    {{ index + 1 }}
                  </h5>
                </div>
                <div class="col-9">
                  <p
                    class="hard text-danger bg-pink rounded"
                    v-if="Server.difficulty == 'Hard'"
                    style="cursor: pointer"
                    @click="goDetails(Server.slug, index)"
                  >
                    {{ $t("message.Hard") }}
                  </p>
                  <p
                    class="hard text-success bg-green rounded"
                    v-if="Server.difficulty == 'Easy'"
                  >
                    {{ $t("message.Easy") }}
                  </p>
                  <p
                    class="hard text-orange bg-orange rounded"
                    v-if="Server.difficulty == 'Medium'"
                  >
                    {{ $t("message.Medium") }}
                  </p>
                  <h5
                    class="font-weight-bold"
                    style="cursor: pointer"
                    @click="goDetails(Server.slug, index)"
                  >
                    {{ Server.url.replace(/[http:// https://]/g, "") }}
                  </h5>
                </div>
              </div>
              <div class="row"></div>
              <p
                class="zuko-text"
                style="cursor: pointer; color: gray"
                @click="goDetails(Server.slug, index)"
              >
                {{ Server.title }}
              </p>
              <p class="mt-4">
                <span>
                  <img src="/img/like.png" class="img-fluid" alt="" />
                </span>
                <span class="text-success">{{ Server.realtimeVote }}</span>
                <span class="mx-3 text-secondary">|</span>
                <span>
                  <i class="fa fa-external-link-alt text-secondary font-13"></i>
                </span>
                <span class="text-secondary font-13">{{ Server.viewd }}</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-7 m-auto">
          <a>
            <img
              @click="Check_last_vote(Server.url, Server.has_vote_in_12)"
              :src="Server.banner"
              class="img-fluid rounded"
              style="cursor: pointer; height: 120px; width: 550px"
              :alt="Server.title"
              onerror="this.src='/img/550120.jpg'"
            />
          </a>
        </div>
      </div>
    </div>

    <div class="text-center" v-if="Servers.length != 0">
      <paginate
        v-model="page"
        :page-count="total"
        :page-range="3"
        :margin-pages="2"
        :click-handler="handelPagination"
        :prev-text="'<'"
        :next-text="'>'"
        :page-class="'btn btn-outline-dark mx-1'"
        :prev-class="'btn btn-outline-dark mx-1'"
        :next-class="'btn btn-outline-dark mx-1'"
      >
      </paginate>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      visit_url: "",
      Servers: [],
      page: 1,
      total: 1,
    };
  },
  methods: {
    visit() {
      window.open(this.visit_url, "_blank");
    },
    Check_last_vote(url, status) {
      if (status) {
        window.open(url, "_blank");
      } else {
        this.visit_url = url;
        this.$modal.show("warm");
      }
    },
    goDetails(slug, index) {
      something.$emit("index", index);

      this.$router.push({ path: `/serverdetails/${slug}` });
    },
    handelPagination(pageNum) {
      this.axios
        .get("/api/GetServers?page=" + pageNum)
        .then((response) => {
          this.Servers = response.data.data;
          this.total = response.data.meta.last_page;
        })
        .catch((errors) => {});
    },
    GetServers() {
      this.axios
        .get("/api/GetServers")
        .then((response) => {
          this.Servers = response.data.data;
          this.total = response.data.meta.last_page;
        })
        .catch((errors) => {});
    },
  },
  created() {
    this.GetServers();
    something.$on("search", (value) => {
      if (value == "") {
        this.GetServers();
      } else {
        this.axios
          .get("/api/GetServers/" + value)
          .then((response) => {
            this.Servers = response.data.data;
            this.total = response.data.meta.last_page;
          })
          .catch((errors) => {});
      }
    });
  },
};
</script>

<style scoped>
</style>
