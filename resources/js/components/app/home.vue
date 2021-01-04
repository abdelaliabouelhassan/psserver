<template>
  <div>
    <div v-if="Servers.length == 0" style="text-align: center; margin-top: 100px;">
        <b>No Records Found</b>
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
                <img src="/img/down.png" alt="" />
            </div>
            {{ Server.upDown }}
            <div class="col-10 m-auto" >
              <div class="row">
                <div class="col-3">
                  <h5 class="d-inline-block px-3 py-2 rounded text-white" style="cursor:pointer"  @click="goDetails(Server.slug)">
                    {{ index + 1 }}
                      
                  </h5>
                </div>
                <div class="col-9">
                    <p class="hard text-danger bg-pink rounded" v-if="Server.difficulty == 'Hard'" style="cursor:pointer"  @click="goDetails(Server.slug)">Hard</p>
                                           <p class="hard text-success bg-green rounded"  v-if="Server.difficulty == 'Easy'"  >
                                                Easy
                                            </p>
                                             <p class="hard text-orange bg-orange rounded"  v-if="Server.difficulty == 'Medium'" >
                                                Medium
                                            </p>
                  <h5 class="font-weight-bold" style="cursor:pointer" @click="goDetails(Server.slug)">
                    {{ Server.url.replace(/[http:// https://]/g, "") }}
                  </h5>
                </div>
              </div>
              <div class="row"></div>
              <p class="zuko-text" style="cursor:pointer"  @click="goDetails(Server.slug)">{{ Server.title }}</p>
              <p class="mt-4">
                <span>
                  <img src="/img/like.png" class="img-fluid" alt="" />
                </span>
                <span class="text-success">{{Server.realtimeVote}}</span>
                <span class="mx-3 text-secondary">|</span>
                <span>
                  <i class="fa fa-external-link-alt text-secondary font-13"></i>
                </span>
                <span class="text-secondary font-13">{{Server.viewd}}</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-sm-7 m-auto">
          <a :href="Server.url" target="_blank">
            <img
              :src="Server.banner"
              class="img-fluid rounded"
              style="cursor: pointer;height: 183px; width: 100%"
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
      Servers: [],
      page: 1,
      total: 1,
    };
  },
  methods: {
    goDetails(slug){
      this.$router.push({path:  `/serverdetails/${slug}`})
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
       if(value == ""){
this.GetServers();
       }else{
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
