<template>
  <div class="card mt-5 px-4 py-5 bg-white">
    <div
      v-if="!this.$store.state.islogin"
      class="alert alert-dark"
      role="alert"
    >
      You need to login in first then you can create a new server !.
      <a href="javascript:void(0)" v-on:click="login_modal"> click to login </a>
    </div>
    <div
      v-if="
        this.$store.state.user.email_verified_at == null &&
        this.$store.state.islogin
      "
      class="alert alert-dark"
      role="alert"
    >
      You need to verify your email first then you can create a new server !.
      <a
        href="javascript:void(0)"
        v-show="emailVrf"
        v-on:click="SendEmailVerfication"
        >click to send another verification email
      </a>
    </div>

    <h6 class="font-weight-bold">Add New Server</h6>
    <div>
 <b>Rules :</b>
    <div class="alert alert-info" role="alert">
        <ul>
          <li>
              Following pages are strictly prohibited from participating :
                <ol>
                  <li>1. Sites with exaggerated much banner advertising or <b>malware</b></li>
                  <li>2. Pages which do not have Game content</li>
                  <li>3. Toplists</li>
                  <li>4. Sites that infringe applicable law</li>
                </ol>
          </li>
          <li>
            The title and description must be in accordance with the content of the page
          </li>
          <li>
            Violations of these rules and fraud (so-called cheating) will result the suspension of your account
          </li>
          <li>
            <span class="text-danger">Your server will be displayed when approved by the administrators</span>
          </li>
        </ul>
    </div>
    </div>
<!-- Steps -->
    <div class="mt-4" v-if="ndStep">
      <div class="row">
        <div class="col-md-12">
      <label for="Description">Your Backlink. You need to add them in your website :</label>  
      <textarea
        name=""
        id="Description"
        cols="30"
        rows="5"
        class="form-control mt-2 rounded"
        placeholder="Your Backlink You need to add them in your website "  
      >
       <a href="{{link}}" title="Metin2 P Server">Metin2 P Server</a>
      </textarea>
         <input
        :disabled="checkuser"
        type="submit"
        class="btn btn-dark d-block bg-dark mt-3"
        value="Done"
        @click="ndStep = false;endStep = true"
      />
       </div>
       
       </div>
    </div>    

    <div class="mt-4" v-if="firstStep">
      <div class="row">
         <div class="col-md-12">
          <label for="title">Server title :</label>
            <span class="text-danger" v-if="errors.title">{{
            this.errors.title[0]
          }}</span>
          <input
           :class="{ 'is-invalid': errors.title }"
            type="text"
            id="title"
            class="form-control rounded my-2"
            placeholder="Server title "
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
        :disabled="checkuser"
        type="submit"
        class="btn btn-dark d-block bg-dark mt-3"
        value="Generate Backlink"
        @click="GenerateLink"
      />
       </div>
       
       </div>
    </div>    
     
    <div class="mt-4" v-if="endStep">
      <div class="row">
       
      
        <div class="col-md-12">
          <label for="Banner">Banner :</label>
           <span class="text-danger" v-if="errors.Banner">{{
            this.errors.Banner[0]
          }}</span>
         <div class="custom-file">
    <input type="file" class="custom-file-input"  :class="{ 'is-invalid': errors.Banner }"  @change="UploadBanner"  id="validatedCustomFile" required>
    <label class="custom-file-label" for="validatedCustomFile">Banner Is displayed as 468x190 (max. 1 mb)</label>
    
  </div>
        </div>
        <div class="col-md-12">
          <label for="Category">Category :</label>
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
          <label for="Category">Difficulty :</label>
           <span class="text-danger" v-if="errors.Difficulty">{{
            this.errors.Difficulty[0]
          }}</span>
          <select
           :class="{ 'is-invalid': errors.Difficulty }"
            id="Category"
            class="form-control rounded my-2"
            v-model="form.Difficulty"
          >
            <option value="Easy">Easy</option>
            <option value="Medium">Medium</option>
            <option value="Hard">Hard</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="Language">Language :</label>
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
            <option value="Deutsch">Deutsch</option>
            <option value="English">English</option>
            <option value="Espanol">Espanol</option>
            <option value="France">France</option>
            <option value="Roman">Roman</option>
          </select>
        </div>
        <div class="col-md-12">
          <label for="max">Max. Level :</label>
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
          <label for="youtube">YouTube Trailer ID :</label>
           <span class="text-danger" v-if="errors.YouTube">{{
            this.errors.YouTube[0]
          }}</span>
          <input
           :class="{ 'is-invalid': errors.YouTube }"
            type="url"
            step="any"
            id="youtube"
            class="form-control rounded my-2"
            placeholder="YouTube Trailer ID "
            v-model="form.YouTube"
          />
        </div>
        <div class="col-md-12">
          <label for="Rates">Rates (%) :</label>
           <span class="text-danger" v-if="errors.Rates">{{
            this.errors.Rates[0]
          }}</span>
          <input
           :class="{ 'is-invalid': errors.Rates }"
            type="number"
            step="any"
            id="Rates"
            class="form-control rounded my-2"
            placeholder="Rates % "
            v-model="form.Rates"
          />
        </div>
      </div>
      <label for="Description">Description :</label>
        <span class="text-danger" v-if="errors.Description">{{
            this.errors.Description[0]
          }}</span>
      <textarea
       :class="{ 'is-invalid': errors.Description }"
        name=""
        id="Description"
        cols="30"
        rows="5"
        class="form-control mt-2 rounded"
        placeholder="Description"
        v-model="form.Description"
      ></textarea>
      <div>
  <vue-recaptcha @verify="checkRecaptcha" :sitekey="$store.state.sitekey"></vue-recaptcha>
      </div>
      

  <div>
 <input
        :disabled="checkuser"
        type="submit"
        class="btn btn-dark d-block bg-dark mt-3"
        value="Create"
         style="display:inline-block" 
        @click="createServer"
      />
       <input 
       style="display:inline-block" 
        type="submit"
        class="btn btn-dark d-block bg-dark mt-3"
        value="Back"
        @click="ndStep = true; endStep = false"
      />
    </div>
  </div>
     
  </div>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';

export default {
   components: { VueRecaptcha },
  data() {
    return {
      clicked:false,
      emailVrf: true,
      firstStep:true,
      endStep:false,
      ndStep:false,
      link:'',
      errors:[],
      form: {
        id:"",
        URL: "",
        title: "",
        Banner: "",
        Category: "",
        Language: [],
        Level: "",
        YouTube: "",
        Rates: "",
        Description: "",
        Difficulty:"",
        isGif:false,
        ReqResponse:''
      },
    };
  },
  methods: {
     checkRecaptcha(response){
         this.form.ReqResponse = response   
    },
    GenerateLink(){
     this.clicked = true
      this.axios
        .post("/api/GenerateLink", this.form)
        .then((response) => { 
          console.log(response)
           this.clicked = false   
           this.firstStep = false  
           this.ndStep = true  
           this.link = response.data.link  
           this.form.id  = response.data.id,
          Toast.fire({
            icon: "success",
            title: "Backlink Geneated Successfully",
          });
        })
        .catch((errors) => {  
          this.clicked = false 
           if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
           Toast.fire({
            icon: "error",
            title: "Please check the error above .",
          });
          }else{
            Toast.fire({
            icon: "error",
            title: "Something went wrong please try again .",
          });
          }      
          
        });
    },
    UploadBanner(e){
           
                let file = e.target.files[0];
                let reader = new FileReader();
                if(file['type']==='image/jpeg' || file['type']==='image/png' || file['type'] === 'image/gif'){
                
                    if(file['size'] < 1111775){
                            if(file['type'] === 'image/gif'){
                              this.form.isGif = true;
                            }
                        reader.onloadend = (file) =>{
                            this.form.Banner = reader.result
                        }
                        reader.readAsDataURL(file)
                    }else{
                        swalWithBootstrapButtons.fire(
                            'The Banner has not been uploaded.',
                            'The Banner Size > 1 mb .',
                            'error'
                        )             
                    }
                }else{
                    swalWithBootstrapButtons.fire(
                        'The image has not been uploaded.',
                        'The File You Selected Is Not Banner.',
                        'error'
                    )
                    
                }

    },
    createServer() {
      this.clicked = true
      this.axios
        .post("/api/createserver", this.form)
        .then((response) => { 
           this.clicked = false 
          Toast.fire({
            icon: "success",
            title: "Server Created Successfully",
          });
        })
        .catch((errors) => {  
          this.clicked = false 
           if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
             Toast.fire({
            icon: "error",
            title: "Please check the error above .",
          });
          }else if(errors.response.status == 403){
            Toast.fire({
            icon: "error",
            title: errors.response.data,
          });
          }
          else{
            Toast.fire({
            icon: "error",
            title: "Something went wrong please try again .",
          });
          }      
          
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
            title: "Verification email sent successfully",
          });
        })
        .catch((errors) => {
          this.emailVrf = true;
          Toast.fire({
            icon: "error",
            title: "Something went wrong please try again .",
          });
        });
    },
    login_modal() {
      something.$emit("login_modal");
    },
  },
  computed: {
    checkuser() {  if (this.$store.state.islogin) {
        if (this.$store.state.user.email_verified_at != null) {
         if(this.clicked){
          return true
        }else{
          return false
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
