<template>
  <div class="card mt-5 px-4 py-5 bg-white">
    
   

    <h6 class="font-weight-bold">{{$t('message.Edit_Server')}}</h6>
  
    
     
    <div class="mt-4">
      <div class="row">
        <div class="col-md-12">
          <label for="pageurl">Page URL :</label>
          <span class="text-danger" v-if="errors.url">{{
            this.errors.url[0]
          }}</span>
          <input
            :class="{ 'is-invalid': errors.url }"
            type="url"
            id="pageurl"
            class="form-control rounded my-2"
            placeholder="Page URL"
            v-model="form.url"
          />
        </div>
        <div class="col-md-12">
          <label for="title">{{$t('message.Server_title')}} :</label>
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
          <label for="Banner">{{$t('message.Banner')}} :</label>
           <span class="text-danger" v-if="errors.banner">{{
            this.errors.banner[0]
          }}</span>
         <div class="custom-file">
    <input type="file" class="custom-file-input"  :class="{ 'is-invalid': errors.banner }"  @change="UploadBanner"  id="validatedCustomFile" required>
    <label class="custom-file-label" for="validatedCustomFile">Banner Is displayed as 468x190 (max. 1 mb)</label>
    
  </div>
        </div>
        <div class="col-md-12">
          <label for="Category">{{$t('message.Category')}} :</label>
           <span class="text-danger" v-if="errors.category">{{
            this.errors.category[0]
          }}</span>
          <select
           :class="{ 'is-invalid': errors.category }"
            id="Category"
            class="form-control rounded my-2"
            v-model="form.category"
          >
            <option value="Oldschool Root">Oldschool Root</option>
            <option value="Oldschool Root">Oldschool Root</option>
            <option value="NewSchool Root">NewSchool Root</option>
          </select>
        </div>
         <div class="col-md-12">
          <label for="Category">{{$t('message.Difficulty')}}  :</label>
           <span class="text-danger" v-if="errors.difficulty">{{
            this.errors.difficulty[0]
          }}</span>
          <select
           :class="{ 'is-invalid': errors.difficulty }"
            id="Category"
            class="form-control rounded my-2"
            v-model="form.difficulty"
          >
            <option value="Easy">{{$t('message.Easy')}} </option>
            <option value="Medium">{{$t('message.Medium')}} </option>
            <option value="Hard">{{$t('message.Hard')}} </option>
          </select>
        </div>
        
        <div class="col-md-12">
          <label for="max">{{$t('message.Max_Level')}} :</label>
           <span class="text-danger" v-if="errors.maxlevel">{{
            this.errors.maxlevel[0]
          }}</span>
          <input
          :class="{ 'is-invalid': errors.maxlevel }"
            v-model="form.maxlevel"
            type="number"
            id="max"
            step="any"
            class="form-control rounded my-2"
            :placeholder="$t('message.Max_Level')"
          />
        </div>

        <div class="col-md-12">
          <label for="youtube">{{$t('message.YouTube')}}:</label>
           <span class="text-danger" v-if="errors.youtube_id">{{
            this.errors.youtube_id[0]
          }}</span>
          <input
           :class="{ 'is-invalid': errors.youtube_id }"
            type="url"
            step="any"
            id="youtube"
            class="form-control rounded my-2"
            :placeholder="$t('message.YouTube') "
            v-model="form.youtube_id"
          />
        </div>
        <div class="col-md-12">
          <label for="Rates">Rates (%) :</label>
           <span class="text-danger" v-if="errors.rates">{{
            this.errors.rates[0]
          }}</span>
          <input
           :class="{ 'is-invalid': errors.rates }"
            type="number"
            step="any"
            id="Rates"
            class="form-control rounded my-2"
            placeholder="Rates % "
            v-model="form.rates"
          />
        </div>
      </div>
      <label for="Description">{{$t('message.Description')}} :</label>
        <span class="text-danger" v-if="errors.description">{{
            this.errors.description[0]
          }}</span>
      <textarea
       :class="{ 'is-invalid': errors.description }"
        name=""
        id="Description"
        cols="30"
        rows="5"
        class="form-control mt-2 rounded"
        :placeholder="$t('message.Description')"
        v-model="form.description"
      ></textarea>

      <input
       v-if="$store.state.islogin && !$store.state.user.is_banned || !$store.state.islogin"
        :disabled="checkuser"
        type="submit"
        class="btn btn-dark d-block bg-dark mt-3"
        value="Create"
        @click="updateserver"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      clicked:false,
      emailVrf: true,
      firstStep:true,
      endStep:false,
      ndStep:false,
      link:'',
      errors:[],
      form: [],
    };
  },
  created(){
      this.getServerInfo();
  },
  methods: {
      getServerInfo(){
        this.axios
        .get("/api/getServerInfo/" +this.$route.params.slug)
        .then((response) => { 
          this.form = response.data
         
        })
        .catch((errors) => {  
              this.$router.push({path:'/notfound'});
        });
      },
    UploadBanner(e){
           
                let file = e.target.files[0];
                let reader = new FileReader();
                if(file['type']==='image/jpeg' || file['type']==='image/png' || file['type'] === 'image/gif'){
                
                    if(file['size'] < 1111775){
                            
                        reader.onloadend = (file) =>{
                            this.form.banner = reader.result
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
    updateserver() {
      this.clicked = true
      this.axios
        .post("/api/updateServer/", this.form)
        .then((response) => { 
           this.clicked = false 
          Toast.fire({
            icon: "success",
            title: this.$t('message.Server_Updated_Successfully'),
          });
        })
        .catch((errors) => {  
          this.clicked = false 
           if (errors.response.status == 422) {
            this.errors = errors.response.data.errors;
             Toast.fire({
            icon: "error",
            title: this.$t('message.Please_errors'),
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
            title: this.$t('message.Something_went_wrong'),
          });
          }      
          
        });
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
