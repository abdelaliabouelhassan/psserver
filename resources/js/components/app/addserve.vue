<template>
  <div class="card mt-5 px-4 py-5 bg-white">
    <div
      v-if="!this.$store.state.islogin"
      class="alert alert-dark"
      role="alert"
    >
      {{ $t("message.You_need_to_login") }}
      <a href="javascript:void(0)" v-on:click="login_modal">
        {{ $t("message.click_to_login") }}
      </a>
    </div>
    <div
      v-if="
        this.$store.state.user.email_verified_at == null &&
        this.$store.state.islogin
      "
      class="alert alert-dark"
      role="alert"
    >
      {{ $t("message.verify_your_email") }}
      <a
        href="javascript:void(0)"
        v-show="emailVrf"
        v-on:click="SendEmailVerfication"
        >{{ $t("message.send_another") }}
      </a>
    </div>

    <h6 class="font-weight-bold" v-if="this.$store.state.islogin">{{ $t("message.Add_New_Server") }}</h6>
    <div>
      <b>{{ $t("message.Rules") }}</b>
      <div class="alert alert-info" role="alert">
        <ul>
          <li>
            {{ $t("message.Following_participating") }}
            <ol>
              <li>{{ $t("message.rule1") }} <b>malware</b></li>
              <li>{{ $t("message.rule2") }}</li>
              <li>{{ $t("message.rule3") }}</li>
              <li>{{ $t("message.rule4") }}</li>
            </ol>
          </li>
          <li>
            {{ $t("message.rule5") }}
          </li>
          <li>
            {{ $t("message.rule6") }}
          </li>
          <li>
            <span class="text-danger">{{ $t("message.rule7") }}</span>
          </li>
        </ul>
      </div>
    </div>
    <!-- Steps -->
    <div class="mt-4" v-if="ndStep">
      <div class="row">
        <div class="col-md-12">
          <label for="Description">{{ $t("message.backlink") }}</label>
          <textarea
            name=""
            id="Description"
            cols="30"
            rows="5"
            class="form-control mt-2 rounded"
            :placeholder="$t('message.Backlink_website')"
          >
       <a href="{{ link }}" title="Metin2 P Server">Metin2 P Server</a>
       bbcode
       [url]{{ link }}[/url]
       or
       [url={{ link }}]Metin2 P Server[/url]
      </textarea
          >
<br>
 <b>How To Use </b>
      <div class="alert alert-info" role="alert">
             <ul>
          <li>
             Copy the URL and put it in your server (in the URL you provided us )
          </li>
        </ul>
      </div>



          <input
            :disabled="checkuser"
            type="submit"
            class="btn btn-dark d-block bg-dark mt-3"
            value="Done"
            @click="
              ndStep = false;
              endStep = true;
            "
          />
        </div>
      </div>
    </div>

    <div class="mt-4" v-if="firstStep">
      <div class="row">
        <div class="col-md-12">
          <label for="title">{{ $t("message.Server_title") }} :</label>
          <span class="text-danger" v-if="errors.title">{{
            this.errors.title[0]
          }}</span>
          <input
            :class="{ 'is-invalid': errors.title }"
            type="text"
            id="title"
            class="form-control rounded my-2"
            :placeholder="$t('message.Server_title')"
            v-model="form.title"
          />
        </div>
        <div class="col-md-12">
          <label for="pageurl">Page URL :</label>
          <span class="text-danger" v-if="errors.URL">{{
            this.errors.URL[0]
          }}</span>
          <input
            :class="{ 'is-invalid': errors.URL }"
            type="url"
            id="pageurl"
            class="form-control rounded my-2"
            placeholder="Page URL"
            v-model="form.URL"
          />

          <input
            v-if="
              ($store.state.islogin && !$store.state.user.is_banned) ||
              !$store.state.islogin
            "
            :disabled="checkuser"
            type="submit"
            class="btn btn-dark d-block bg-dark mt-3"
            :value="$t('message.Generate_Backlink')"
            @click="GenerateLink"
          />
        </div>
      </div>
    </div>

    <div class="mt-4" v-if="endStep">
      <div class="row">
        <div class="col-md-12">
          <label for="Banner">{{ $t("message.Banner") }} :</label>
          <span class="text-danger" v-if="errors.Banner">{{
            this.errors.Banner[0]
          }}</span>
          <div class="custom-file">
            <input
              type="file"
              class="custom-file-input"
              :class="{ 'is-invalid': errors.Banner }"
              @change="UploadBanner"
              id="validatedCustomFile"
              required
            />
            <label class="custom-file-label" for="validatedCustomFile"
              >Banner Is displayed as 468x190 (max. 1 mb)</label
            >
          </div>
        </div>
        <div class="col-md-12">
          <label for="Category">{{ $t("message.Category") }} :</label>
          <span class="text-danger" v-if="errors.Category">{{
            this.errors.Category[0]
          }}</span>
          <select
            :class="{ 'is-invalid': errors.Category }"
            id="Category"
            class="form-control rounded my-2"
            v-model="form.Category"
          >
            <option value="Oldschool Root">Oldschool Root</option>
            <option value="Oldschool Root">Oldschool Root</option>
            <option value="NewSchool Root">NewSchool Root</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="Category">{{ $t("message.Difficulty") }} :</label>
          <span class="text-danger" v-if="errors.Difficulty">{{
            this.errors.Difficulty[0]
          }}</span>
          <select
            :class="{ 'is-invalid': errors.Difficulty }"
            id="Category"
            class="form-control rounded my-2"
            v-model="form.Difficulty"
          >
            <option value="Easy">{{ $t("message.Easy") }}</option>
            <option value="Medium">{{ $t("message.Medium") }}</option>
            <option value="Hard">{{ $t("message.Hard") }}</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="Language">{{ $t("message.Language") }} :</label>
          <span class="text-danger" v-if="errors.Language">{{
            this.errors.Language[0]
          }}</span>
          <select
            :class="{ 'is-invalid': errors.Language }"
            class="form-control rounded my-2"
            id="Language"
            multiple
            data-live-search="true"
            v-model="form.Language"
          >
            
            <option value="English">English</option>
            <option value="Espanol">Espanol</option>
            <option value="France">France</option>
            <option value="Roman">Roman</option>
            <option value="German">German</option>
             <option value="Turkish">Turkish</option>
              <option value="Portuguese">Portuguese</option>
               <option value="Hungarian">Hungarian</option>
               <option value="Greek">Greek</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="max">{{ $t("message.Max_Level") }} :</label>
          <span class="text-danger" v-if="errors.Level">{{
            this.errors.Level[0]
          }}</span>
          <input
            :class="{ 'is-invalid': errors.Level }"
            v-model="form.Level"
            type="number"
            id="max"
            step="any"
            class="form-control rounded my-2"
            placeholder="Max. Level "
          />
        </div>

        <div class="col-md-12">
          <label for="youtube">{{ $t("message.YouTube") }} :</label>
          <span class="text-danger" v-if="errors.YouTube">{{
            this.errors.YouTube[0]
          }}</span>
          <input
            :class="{ 'is-invalid': errors.YouTube }"
            type="url"
            step="any"
            id="youtube"
            class="form-control rounded my-2"
            :placeholder="$t('message.YouTube')"
            v-model="form.YouTube"
          />
        </div>
        <div class="col-md-12">
          <label for="Rates">{{ $t("message.Rates") }} :</label>
          <span class="text-danger" v-if="errors.Rates">{{
            this.errors.Rates[0]
          }}</span>
          <input
            :class="{ 'is-invalid': errors.Rates }"
            type="number"
            step="any"
            id="Rates"
            class="form-control rounded my-2"
            :placeholder="$t('message.Rates')"
            v-model="form.Rates"
          />
        </div>
      </div>
      <label for="Description">{{ $t("message.Description") }} :</label>
      <span class="text-danger" v-if="errors.Description">{{
        this.errors.Description[0]
      }}</span>

     <vue-html5-editor :content="form.Description" @change="updateData"  :class="{ 'is-invalid': errors.Description }"  :height="300"></vue-html5-editor>


      <div>
        <vue-recaptcha
          ref="recaptcha"
          @verify="checkRecaptcha"
          :sitekey="$store.state.sitekey"
        ></vue-recaptcha>
      </div>

      <div>
        <input
          :disabled="checkuser"
          type="submit"
          class="btn btn-dark bg-dark mt-3"
          :value="$t('message.Create')"
          @click="createServer"
        />
        <input
          type="submit"
          class="btn btn-dark bg-dark mt-3"
          :value="$t('message.Back')"
          @click="
            ndStep = true;
            endStep = false;
          "
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
      clicked: false,
      emailVrf: true,
      firstStep: true,
      endStep: false,
      ndStep: false,
      link: "",
      errors: [],
      form: {
        id: "",
        URL: "",
        title: "",
        Banner: "",
        Category: "",
        Language: [],
        Level: "",
        YouTube: "",
        Rates: "",
        Description: "",
        Difficulty: "",
        isGif: false,
        ReqResponse: "",
      },
    };
  },
  methods: {
    updateData(e){
      this.form.Description = e;
    },
    checkRecaptcha(response) {
      this.form.ReqResponse = response;
    },
    GenerateLink() {
      this.clicked = true;
      this.axios
        .post("/api/GenerateLink", this.form)
        .then((response) => {
          console.log(response);
          this.clicked = false;
          this.firstStep = false;
          this.ndStep = true;
          this.link = response.data.link;
          (this.form.id = response.data.id),
            Toast.fire({
              icon: "success",
              title: this.$t("message.Backlink_Geneated_Successfully"),
            });
        })
        .catch((errors) => {
          this.clicked = false;
          if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
            Toast.fire({
              icon: "error",
              title: this.$t("message.Please_errors"),
            });
          } else {
            Toast.fire({
              icon: "error",
              title: this.$t("message.Something_went_wrong"),
            });
          }
        });
    },
    UploadBanner(e) {
      let file = e.target.files[0];
      let reader = new FileReader();
      if (
        file["type"] === "image/jpeg" ||
        file["type"] === "image/png" ||
        file["type"] === "image/gif"
      ) {
        if (file["size"] < 1111775) {
          if (file["type"] === "image/gif") {
            this.form.isGif = true;
          }
          reader.onloadend = (file) => {
            this.form.Banner = reader.result;
          };
          reader.readAsDataURL(file);
        } else {
          swalWithBootstrapButtons.fire(
            "The Banner has not been uploaded.",
            "The Banner Size > 1 mb .",
            "error"
          );
        }
      } else {
        swalWithBootstrapButtons.fire(
          "The image has not been uploaded.",
          "The File You Selected Is Not Banner.",
          "error"
        );
      }
    },
    createServer() {
      this.clicked = true;
      this.axios
        .post("/api/createserver", this.form)
        .then((response) => {
          this.clicked = false;
          Toast.fire({
            icon: "success",
            title: this.$t("message.Created_Successfully"),
          });
        })
        .catch((errors) => {
          this.clicked = false;
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
          this.$refs.recaptcha.reset();
        });
    },
    SendEmailVerfication() {
      this.emailVrf = false;
      this.axios
        .post("/api/Verification", this.form)
        .then((response) => {
          this.emailVrf = true;
          Toast.fire({
            icon: "success",
            title: this.$t("message.Verification_email_sent_successfully"),
          });
        })
        .catch((errors) => {
          this.emailVrf = true;
          Toast.fire({
            icon: "error",
            title: this.$t("message.Something_went_wrong"),
          });
        });
    },
    login_modal() {
      something.$emit("login_modal");
    },
  },
  computed: {
    checkuser() {
      if (this.$store.state.islogin) {
        if (this.$store.state.user.email_verified_at != null) {
          if (this.clicked) {
            return true;
          } else {
            return false;
          }
        } else {
          return true;
        }
      } else {
        return true;
      }
    },
  },
};
</script>

<style scoped>
</style>
