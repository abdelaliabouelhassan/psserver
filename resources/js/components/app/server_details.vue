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

    <div class="card serverCard p-4 mb-3 mt-5">
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
              <a href="">
                <img src="/img/avatar.png" alt="" />
              </a>
            </div>
            <div class="col-10 m-auto">
              <div class="row">
                <div class="col-3">
                  <h5 class="d-inline-block px-3 py-2 rounded text-white">1</h5>
                </div>
                <div class="col-9">
                  <p
                    class="hard text-danger bg-pink rounded"
                    v-if="Server.difficulty == 'Hard'"
                    style="cursor: pointer"
                    @click="goDetails(Server.slug)"
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
                  <h5 class="font-weight-bold">{{ url }}</h5>
                </div>
              </div>
              <div class="row"></div>
              <p class="zuko-text">{{ Server.title }}</p>
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
        <div class="col-sm-7 m-auto"  style="cursor: pointer"  @click="Check_last_vote(Server.url, Server.has_vote_in_12)">
          <img
            :src="'/' + Server.screen"
            onerror="this.src='/img/550120.jpg'"
            class="img-fluid rounded"
            alt=""
            style="height: 183px; width: 100%"
          />
        </div>
      </div>
    </div>

    <!--  -->

    <div class="card my-3 p-3">
      <a
        @click="Check_last_vote(Server.url, Server.has_vote_in_12)"
        target="_blank"
        class="btn btn-dark bg-dark btn-block rounded font-weight-normal"
        >{{ url }} - {{ $t("message.Server_details") }}</a
      >
      <div class="row mt-3">
        <div class="col-md-6">
          <div class="row">
            <div class="col-4 m-auto">
              <p>{{ $t("message.Server_Type") }}:</p>
            </div>
            <div class="col-7">
              <p
                class="hard text-danger bg-pink rounded"
                v-if="Server.difficulty == 'Hard'"
                style="cursor: pointer"
                @click="goDetails(Server.slug)"
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
              <p class="d-inline text-muted ml-2">{{ Server.category }}</p>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-4 m-auto">
              <p>{{ $t("message.Max_Level") }}:</p>
            </div>
            <div class="col-7">
              <p class="d-inline text-muted ml-2">{{ Server.maxlevel }}</p>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-4 m-auto">
              <p>Rates:</p>
            </div>
            <div class="col-7">
              <p class="d-inline text-muted ml-2">{{ Server.rates }}%</p>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-4 m-auto">
              <p>{{ $t("message.Votes") }}:</p>
            </div>
            <div class="col-7">
              <p class="d-inline text-success ml-2">
                {{ Server.realtimeVote }}
              </p>
            </div>
          </div>
          <hr />
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-4 m-auto">
              <p>{{ $t("message.Website") }}:</p>
            </div>
            <div class="col-7"  style="cursor: pointer">
              <p class="d-inline text-muted ml-2">
                <a
                  @click="Check_last_vote(Server.url, Server.has_vote_in_12)"
                  target="_blank"
                  class="text-muted"
                  >{{ url }}</a
                >
                <i class="fa fa-external-link-alt"></i>
              </p>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-4 m-auto">
              <p>{{ $t("message.Comments") }}:</p>
            </div>
            <div class="col-7">
              <p class="d-inline text-muted ml-2">{{ comments.length }}</p>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-4 m-auto">
              <p>{{ $t("message.Clicks") }}:</p>
            </div>
            <div class="col-7">
              <p class="d-inline text-muted ml-2">{{ Server.viewd }}</p>
            </div>
          </div>
          <hr />
          <div class="row">
            <div class="col-4 m-auto">
              <p>{{ $t("message.Server_start") }}:</p>
            </div>
            <div class="col-7">
              <p class="d-inline text-muted ml-2">{{ Server.created_at }}</p>
            </div>
          </div>
          <hr />
        </div>
      </div>
      <div class="text-center mt-4">
        <a
          href="javascript:void(0)"
          class="text-dark text-decoration-none font-weight-bold"
          @click="modalRate"
          >{{ $t("message.Rate_Server") }}</a
        >
      </div>
    </div>

    <!--  -->

    <h3 class="my-5 font-weight-bold">
      {{ $t("message.Feedback") }} & {{ $t("message.Comments") }}:
      <span>{{ comments.length }}</span>
    </h3>
               <button
                 v-if="$store.state.user.is_admin && Server.is_comment"
                @click="unActive(Server.id)"
                class="btn btn-danger bg-danger p-0 px-2 mr-2 rounded"
                style="font-size: 10px"
              >
                unActive Comment  
              </button>

                <button
                 v-if="$store.state.user.is_admin && !Server.is_comment"
                @click="active(Server.id)"
                class="btn btn-success bg-success p-0 px-2 mr-2 rounded"
                style="font-size: 10px"
              >
                Active Comment  
              </button>

    <div
      class="card my-3"
      v-if="!showReplay && Server.is_comment"
      v-for="comment in comments"
    >
      <div class="row p-3">
        <div class="col-1 p-0 m-auto">
          <img src="/img/avatar.png" class="img-fluid" alt="" />
        </div>
        <div class="col-11 p-0 pl-2">
          <div class="row">
            <div class="col-3">
              <h6 class="font-14 m-0">{{ comment.username }}</h6>
            </div>
            <div class="col-3">
              <p>{{ comment.created_at }}</p>
            </div>
            <div class="col-2">
              <i class="fa fa-heart text-muted font-14" v-if="comment.rate"></i
              ><span class="font-14 ml-1">{{ comment.rate }}</span>
            </div>
            <div class="col-4 text-right pr-3">
              <button
                @click="openReplayModal(comment.id)"
                class="btn btn-dark bg-dark p-0 px-2 mr-2 rounded"
                style="font-size: 10px"
              >
                {{ $t("message.REPLY") }}
              </button>
                 <button
                 v-if="$store.state.user.is_admin"
                @click="DeleteComment(comment.id)"
                class="btn btn-danger bg-danger p-0 px-2 mr-2 rounded"
                style="font-size: 10px"
              >
                Delete 
              </button>
                <button
                 v-if="$store.state.user.is_admin && !comment.is_banned"
                @click="banUser(comment.user_id)"
                class="btn btn-danger bg-danger p-0 px-2 mr-2 rounded"
                style="font-size: 10px"
              >
                ban user 
              </button>
               <button
                 v-if="$store.state.user.is_admin && comment.is_banned"
                @click="unBanUser(comment.user_id)"
                class="btn btn-success bg-success p-0 px-2 mr-2 rounded"
                style="font-size: 10px"
              >
                UnBan user 
              </button>
            </div>
          </div>
          <p class="font-14">
            {{ comment.comment }}
          </p>
          <a
            href="javascript:void(0)"
            v-if="comment.replay.length != 0"
            @click="showReplays(comment.replay)"
            >show replays</a
          >
        </div>
      </div>
    </div>
    <a href="javascript:void(0)" v-if="showReplay" @click="showReplay = false"
      >Hide Replays</a
    >
    <div class="card my-3" v-if="showReplay" v-for="comment in replays">
      <div class="row p-3">
        <div class="col-1 p-0 m-auto">
          <img src="/img/avatar.png" class="img-fluid" alt="" />
        </div>
        <div class="col-11 p-0 pl-2">
          <div class="row">
            <div class="col-3">
              <h6 class="font-14 m-0">{{ comment.username }}</h6>
            </div>
            <div class="col-3">
              <p>{{ comment.created_at }}</p>
            </div>
          </div>
          <p class="font-14">
            {{ comment.comment }}
          </p>
        </div>
      </div>
    </div>

    <modal name="replay" :height="500">
      <div class="my-3 px-4 py-5 bg-white">
        <h6 class="font-weight-bold">{{ $t("message.Add_Your_Replay") }}</h6>
        <span class="text-danger" v-if="errors.username"
          >{{ this.errors.username[0] }}
        </span>
        <div class="mt-4">
          <div class="row">
            <div class="col-md-6" v-if="!$store.state.islogin">
              <input
                type="text"
                class="form-control rounded my-2"
                :placeholder="$t('message.Email')"
                v-model="replayForm.email"
                :class="{ 'is-invalid': errors.email }"
              />
            </div>
            <div class="col-md-6" v-if="!$store.state.islogin">
              <input
                type="text"
                class="form-control rounded my-2"
                :placeholder="$t('message.Username')"
                v-model="replayForm.username"
                :class="{ 'is-invalid': errors.username }"
              />
            </div>
          </div>
          <textarea
            :class="{ 'is-invalid': errors.comment }"
            name=""
            id=""
            cols="30"
            rows="5"
            class="form-control mt-2 rounded"
            placeholder="I think..."
            v-model="replayForm.comment"
          ></textarea>
          <vue-recaptcha
            ref="recaptcha1"
            @verify="checkRecaptcha"
            :sitekey="$store.state.sitekey"
          ></vue-recaptcha>

          <input
            v-if="
              ($store.state.islogin && !$store.state.user.is_banned) ||
              !$store.state.islogin
            "
            type="submit"
            class="btn btn-dark d-block bg-dark mt-3"
            value="Replay"
            @click="Replay"
            :disabled="clicked"
          />
        </div>
      </div>
    </modal>

    <modal name="Comment" :height="600">
      <div class="my-3 px-4 py-5 bg-white">
        <h6 class="font-weight-bold">Rate Server</h6>
        <span class="text-danger" v-if="errors.username"
          >{{ this.errors.username[0] }}
        </span>
        <div class="mt-4">
          <div class="row">
            <div class="col-md-6">
              <select
                class="form-control rounded my-2"
                placeholder="Your rating "
                id="rating"
                v-model="form.rating"
                :class="{ 'is-invalid': errors.rating }"
              >
                <option value="" selected>
                  {{ $t("message.Select_Your_rating") }}
                </option>
                <option value="Very bad">Very bad</option>
                <option value="Bad">Bad</option>
                <option value="Acceptable">Acceptable</option>
                <option value="Satisfactory">Satisfactory</option>
                <option value="Good">Good</option>
                <option value="Very Good">Very Good</option>
              </select>
            </div>
            <div class="col-md-6" v-if="!$store.state.islogin">
              <input
                type="text"
                class="form-control rounded my-2"
                placeholder="E-mail address"
                v-model="form.email"
                :class="{ 'is-invalid': errors.email }"
              />
            </div>
            <div class="col-md-6" v-if="!$store.state.islogin">
              <input
                type="text"
                class="form-control rounded my-2"
                placeholder="Your User Name"
                v-model="form.username"
                :class="{ 'is-invalid': errors.username }"
              />
            </div>
            <div class="col-md-6">
              <select
                class="form-control rounded my-2"
                placeholder="I am "
                id="Iam"
                v-model="form.iam"
                :class="{ 'is-invalid': errors.iam }"
              >
                <option value="Warrior (m)">Warrior (m)</option>
                <option value="Warrior (f)">Warrior (f)</option>
                <option value="Assasin (m)">Assasin (m)</option>
                <option value="Assasin (f)">Assasin (f)</option>
                <option value="Sura (m)">Sura (m)</option>
                <option value="Sura (f)">Sura (f)</option>
                <option value="Shaman (m)">Shaman (m)</option>
                <option value="Shaman (f)">Shaman (f)</option>
              </select>
            </div>
          </div>
          <textarea
            :class="{ 'is-invalid': errors.comment }"
            name=""
            id=""
            cols="30"
            rows="5"
            class="form-control mt-2 rounded"
            placeholder="I think..."
            v-model="form.comment"
          ></textarea>
          <input
            type="checkbox"
            :class="{ 'is-invalid': errorTos }"
            v-model="tos"
          /><label for="check" class="ml-2 my-2 terms"
            ><span class="" :class="{ 'text-danger': errorTos }"
              >{{ $t("message.I_have_read") }}
            </span>
            <a
              href=""
              class="text-success font-16"
              :class="{ 'text-danger': errorTos }"
              >Terms of Use</a
            ></label
          >
          <vue-recaptcha
            ref="recaptcha2"
            @verify="checkRecaptcha"
            :sitekey="$store.state.sitekey"
          ></vue-recaptcha>

          <input
            v-if="
              ($store.state.islogin && !$store.state.user.is_banned) ||
              !$store.state.islogin
            "
            type="submit"
            class="btn btn-dark d-block bg-dark mt-3"
            value="Enter"
            @click="Rate"
            :disabled="clicked"
          />
        </div>
      </div>
    </modal>

    <div class="my-3 px-4 py-5 bg-white" v-if="Server.is_comment">
      <h6 class="font-weight-bold">{{ $t("message.Add_Comment") }}</h6>
      <span class="text-danger" v-if="errors.username"
        >{{ this.errors.username[0] }}
      </span>
      <div class="mt-4">
        <div class="row">
          <div class="col-md-6" v-if="!$store.state.islogin">
            <input
              type="text"
              class="form-control rounded my-2"
              :placeholder="$t('message.Email')"
              v-model="comment.email"
              :class="{ 'is-invalid': errors.email }"
            />
          </div>
          <div class="col-md-6" v-if="!$store.state.islogin">
            <input
              type="text"
              class="form-control rounded my-2"
              :placeholder="$t('message.Username')"
              v-model="comment.username"
              :class="{ 'is-invalid': errors.username }"
            />
          </div>
        </div>
        <textarea
          :class="{ 'is-invalid': errors.comment }"
          name=""
          id=""
          cols="30"
          rows="5"
          class="form-control mt-2 rounded"
          placeholder="I think..."
          v-model="comment.comment"
        ></textarea>

        <vue-recaptcha
          ref="recaptcha3"
          v-if="show"
          @verify="checkRecaptcha"
          :sitekey="$store.state.sitekey"
        ></vue-recaptcha>

        <input
          v-if="
            ($store.state.islogin && !$store.state.user.is_banned) ||
            !$store.state.islogin
          "
          type="submit"
          class="btn btn-dark d-block bg-dark mt-3"
          value="Enter"
          @click="addcomment"
        />
      </div>
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
      Server: [],
      url: "",
      viUrl: "",
      clicked: false,
      comment: {
        email: "",
        comment: "",
        username: "",
        server_id: "",
        ReqResponse:'',
      },
      form: {
        comment: "",
        rating: "",
        email: "",
        username: "",
        iam: "Warrior (m)",
        server_id: "",
        ReqResponse: "",
      },
      replayForm: {
        comment: "",
        email: "",
        username: "",
        comment_id: "",
        ReqResponse: "",
      },
      errorTos: false,
      tos: false,
      errors: [],
      comments: [],
      replays: [],
      showReplay: false,
      index: 0,
    };
  },
  methods: {
    unActive(id){
 this.axios
        .get("/api/unactive/" + id)
        .then((response) => {      
          Toast.fire({
            icon: "success",
            title: 'User UnBanned',
          });
          this.getServer();
        })
        .catch((errors) => {
        });
    },
    active(id){
 this.axios
        .get("/api/active/" + id)
        .then((response) => {      
          Toast.fire({
            icon: "success",
            title: 'User UnBanned',
          });
          this.getServer();
        })
        .catch((errors) => {
        });
    },
    unBanUser(id){
       this.axios
        .get("/api/Unbanuser/" + id)
        .then((response) => {      
          Toast.fire({
            icon: "success",
            title: 'User UnBanned',
          });
          this.getComments();
        })
        .catch((errors) => {
        });
    },
    
    banUser(id){
    this.axios
        .get("/api/banuser/" + id)
        .then((response) => {      
          Toast.fire({
            icon: "success",
            title: 'User Banned',
          });
          this.getComments();
        })
        .catch((errors) => {
        });
    },
    DeleteComment(id){
       this.axios
        .get("/api/deleteComment/" + id)
        .then((response) => {
          Toast.fire({
            icon: "success",
            title: 'Comment Deleted',
          });
          this.getComments();
        })
        .catch((errors) => {
        });
    },
    visit() {
      window.open(this.viUrl, "_blank");
    },
    Check_last_vote(url, status) {
      if (status) {
        window.open(url, "_blank");
      } else {
        this.viUrl = url;
        this.$modal.show("warm");
      }
    },
    checkRecaptcha(response) {
      this.form.ReqResponse = response;
      this.comment.ReqResponse = response;
      this.comment.ReqResponse = response;
      this.disabel = false;
    },
    showReplays(replays) {
      this.replays = replays;
      this.showReplay = true;
    },
    Replay() {
      this.clicked = true;
      this.clicked = true;
      this.axios
        .post("/api/replay", this.replayForm)
        .then((response) => {
          this.clicked = false;
          Toast.fire({
            icon: "success",
            title: this.$t("message.You_have_replayed"),
          });
          this.getComments();
        })
        .catch((errors) => {
          this.$refs.recaptcha1.reset();
          this.clicked = false;
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
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
    openReplayModal(id) {
      this.replayForm.comment_id = id;
      this.$modal.show("replay");
    },
    getComments() {
      this.axios
        .get("/api/getComments/" + this.$route.params.slug)
        .then((response) => {
          this.comments = response.data.data;
        })
        .catch((error) => {});
    },
    Rate() {
      if (!this.tos) {
        this.errorTos = true;
        return;
      }
      this.form.server_id = this.Server.id;
      this.errorTos = false;
      this.clicked = true;
      this.axios
        .post("/api/Vote", this.form)
        .then((response) => {
          this.clicked = false;
          Toast.fire({
            icon: "success",
            title: this.$t("message.You_have_voted_successfully"),
          });
          this.getComments();
        })
        .catch((errors) => {
          this.$refs.recaptcha2.reset();
          this.clicked = false;
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
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
    modalRate() {
      this.$modal.show("Comment");
    },
    getServer() {
      this.axios
        .get("/api/GetServer/" + this.$route.params.slug)
        .then((response) => {
          this.Server = response.data.data[0];
          this.url = this.Server.url.replace(/[http:// https://]/g, "");
          console.log(response);
        })
        .catch((errors) => {});
    },
    addcomment() {
      this.comment.server_id = this.Server.id;
      this.axios
        .post("/api/addComment", this.comment)
        .then((response) => {
          this.clicked = false;
          Toast.fire({
            icon: "success",
            title: this.$t("message.Comment_Added_successfully"),
          });
          this.getComments();
        })
        .catch((errors) => {
          this.$refs.recaptcha3.reset();
          this.clicked = false;
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
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
  created() {
    var vm = this;
    this.getServer();
    this.getComments();
    setTimeout(() => {
      vm.show = true;
    }, 1000);
  },
};
</script>

<style scoped>
</style>
