<template>
<div>

       <div class="card mt-4 px-3 py-4">
            <table class="table table-striped rounded">
                <thead class="thead-dark bg-dark">
                  <tr>
                    <th>#</th>
                    <th>{{ $t('message.Servername') }} </th>
                    <th>{{ $t('message.Votelink') }}</th>
                    <th>{{ $t('message.Votes') }} </th>
                    <th>{{ $t('message.Clicks') }} </th>
                    <th>{{ $t('message.Actions') }} </th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="py-5" v-for="(myserve,index) in myservers">
                    <td><span class="border bg-white" style="width: 20px !important;height: 20px; border: 1px solid black;">{{index +1}}</span></td>
                    <td>{{myserve.title}}</td>
                    <td>{{myserve.url}}</td>
                    <td>
                        <img src="img/like.png" class="img-fluid" alt="">{{myserve.realtimeVote}}
                    </td>
                    <td>
                        <i class="fa fa-external-link-alt text-dark font-10 mr-1"></i>{{myserve.viewd}}
                    </td>
                    <td class="text-center">
                        <button class="btn btn-dark px-3 py-0 rounded m-0" style="font-size: 12px;" @click="editServer(myserve.slug)">{{ $t('message.edit') }} </button>
                        <button v-if="myserve.status  && myserve.admin_active && myserve.server_owner_active" @click="deactive(myserve.id)" class="btn btn-danger px-3 py-0 rounded m-0" style="font-size: 12px;" >{{ $t('message.Deactivate') }} </button>
                        <button v-if="myserve.status  && myserve.admin_active && !myserve.server_owner_active" @click="active(myserve.id)" class="btn btn-success px-3 py-0 rounded m-0" style="font-size: 12px;" >{{ $t('message.Active') }} </button>
                    </td>
                  </tr>
                
                </tbody>
              </table>
        </div>
        <div class="card py-1 mt-2">
            <div class="text-center">
                <a href="" class="font-weight-bold text-dark text-decoration-none">
                    {{ $t('message.Add_New_Server') }}
                </a>
            </div>
        </div>
        <button class="btn btn-dark bg-dark btn-block rounded text-white font-14 mt-5">{{$t('message.Change_your_password')}}</button>
        <div class="row mt-4">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div action="">
             <span class="text-danger" v-if="errors.old_password">{{
            this.errors.old_password[0]
          }}</span>
               <input type="password" class="form-control rounded my-3" :class="{ 'is-invalid': errors.old_password }" v-model="user.old_password" :placeholder="$t('message.Old_password')">
                     <span class="text-danger" v-if="errors.password">{{
            this.errors.password[0]
          }}</span>
                    <input type="password" class="form-control rounded my-3" :class="{ 'is-invalid': errors.password }" v-model="user.password" :placeholder="$t('message.New_password')">
                    <input type="password" class="form-control rounded my-3" v-model="user.password_confirmation" :placeholder="$t('message.Confirm_Password')">
                    <div class="text-center">
                        <input type="submit" class="btn btn-danger rounded font-14 mt-4" @click="changepassword" :disabled="clicked" :value="$t('message.CHANGE_PASSWORD')">
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
 </div>
</template>

<script>
export default {
  data(){
    return {
      myservers:[],
      errors:[],
      clicked:false,
      server:{
        id:'',
      },
      user:{
        old_password:'',
        password:'',
        password_confirmation:''
      }
    }
  },
  beforeRouteEnter (to, from, next) {
  next(vm => {
        if (vm.$store.state.islogin) {
              next();
            }else{
          vm.$router.push({path:'/home'});
            }
           
    });
    
  },
   created(){
     this.getMyServers();
   },
  methods: {
    deactive(id){
      this.server.id = id
         this.axios
        .post("/api/Deactivate",this.server)
        .then((response) => { 
           this.getMyServers();
         Toast.fire({
            icon: "success",
            title: this.$t('message.Server_Deactivated_Successfully'),
          });
        })
        .catch((errors) => {  

        });
    },
    active(id){
      this.server.id = id
      this.axios
        .post("/api/Active",this.server)
        .then((response) => { 
           this.getMyServers();
          console.log(response)
           Toast.fire({
            icon: "success",
            title: this.$t('message.Server_Activated_Successfully'),
          });
        })
        .catch((errors) => {  

        });
    },  
    editServer(slug){
      this.$router.push({path:'/edit/'+ slug});
    },
    getMyServers(){
           this.axios
        .get("/api/getMyServers")
        .then((response) => { 
         this.myservers = response.data   
        })
        .catch((errors) => {  

        });
    },
     changepassword(){
        this.clicked = true 
        var vm = this
         this.axios
        .post("/api/changepassword", this.user)
        .then((response) => { 
          console.log(response)
           this.clicked = false   
            Toast.fire({
            icon: "success",
            title: this.$t('message.Password_Updated_Successfully'),
          });
           vm.errors = []
        })
        .catch((errors) => {  
          vm.clicked = false 
           if (errors.response.status == 422) {
              vm.clicked = false 
               vm.errors = errors.response.data.errors;
           Toast.fire({
            icon: "error",
            title: this.$t('message.Please_errors'),
          });
          }
           else if (errors.response.status == 403) {
            vm.clicked = false 
             vm.errors = []
           Toast.fire({
            icon: "error",
            title:  errors.response.data,
          });
          }else{         
             vm.clicked = false 
              vm.errors = []
            Toast.fire({
            icon: "error",
            title: this.$t('message.Something_went_wrong'),
          });
          }      
          
        });
     },
  },
};
</script>

<style scoped>
</style>
