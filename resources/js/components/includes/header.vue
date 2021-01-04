<template>
  <div class="header bg-light m-0 bg-dark">
    <div class="row" style="margin-left: 11rem;">
      <div class="col-md-3">
        <div class="logo">
            <router-link to="/"><img src="/img/logo.png" style="width: 90px" alt="" /></router-link>
        
        </div>
      </div>
      <div class="col-md-9 d-flex align-items-center">
        <div class="navigation">
          <nav class="vg-nav">
            <ul class="vg-nav-main-container">
              <li>
                  <router-link to="/home"  class="text-white">HOME</router-link>
               
              </li>

              <li class="dropdown">
                <a href="" class="text-white">SERVERS</a>
                <ul class="left">
                  <li><a href="javascript:void(0)" @click="search('')" class="text-dark">All Servers</a></li>
                  <li><a href="javascript:void(0)" @click="search('Deutsch')" class="text-dark">Deutsch</a></li>
                  <li><a href="javascript:void(0)" @click="search('English')" class="text-dark">English</a></li>
                  <li><a href="javascript:void(0)" @click="search('Espanol')" class="text-dark">Espanol</a></li>
                    <li><a href="javascript:void(0)" @click="search('France')" class="text-dark">France</a></li>
                    <li><a href="javascript:void(0)" @click="search('Roman')" class="text-dark">Roman</a></li>
                </ul>
              </li>
              <li>
                <a href="" class="text-white">PARTNERS</a>
              </li>
              <li >
                 <router-link to="/faq"  class="text-white">FAQ</router-link>
               
                <!-- <ul class="left">
                  <li><a href="" class="text-dark">SERVER 1</a></li>
                  <li><a href="" class="text-dark">SERVER 2</a></li>
                  <li class="dropdown">
                    <a href="" class="text-dark">SERVER 3</a>
                    <ul class="left another">
                      <li><a href="" class="text-dark">SERVER 1</a></li>
                      <li><a href="" class="text-dark">SERVER 2</a></li>
                      <li><a href="" class="text-dark">SERVER 3</a></li>
                    </ul>
                  </li>
                </ul> -->
              </li>
              <li>
                 <router-link to="/contact"  class="text-white">CONTACT</router-link>
            
              </li>
            </ul>
          </nav>
        </div>
        <p class="d-inline my-auto headerbtns" v-if="!$store.state.islogin">
          <a
            @click="login_modal"
            class="btn btn-link text-white ml-5 hidbtn dropdown-toggle text-decoration-none"
            
            >Sign in</a
          >|
          <a
            @click="login_register"
            class="btn btn-link text-white hidbtn text-decoration-none"
            
          >
            <img src="/img/add-user.png" class="img-fluid" alt="" />
            Create Account
          </a>
          <!-- <a href="" class="btn btn-link text-white
                    hidbtn dropdown-toggle">Sign in</a> -->
         <router-link to="/createserver"  class="btn btn-danger ml-2">ADD SERVER</router-link>

        
        </p>
        <p class="my-auto headerbtns ml-5" v-if="$store.state.islogin">
       
         <router-link to="/myprofile"  style="font-size: 0px"  class="btn btn-link text-white hidbtn text-decoration-none" >

            <img src="/img/avatar.png" alt="" style="width: 32px;" />
            <h6>{{ $store.state.user.username }}</h6>
            <!-- <br />
            <p class="user-mail" style="left: 0px">
              {{ $store.state.user.email }}
            </p> -->
          </router-link>

          <a
            href=""
            class="btn btn-link text-white hidbtn text-decoration-none"
          >
          </a>
          <!-- <a href="" class="btn btn-link text-white
            hidbtn dropdown-toggle">Sign in</a> -->
          <button class="btn btn-danger logout" @click="logout">LOG OUT</button>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    search(server) {
      something.$emit("search", server);
      if(this.$route.path != '/'){
            this.$router.push({ path: "/" });
     }
      
    },
      login_modal(){
           something.$emit("login_modal");
      },
      login_register(){
            something.$emit("login_register");
      },
    logout() {
      var vm = this
      this.axios
        .get("/api/logout")
        .then((response) => {
          console.log(response);
          this.$store.state.islogin = false
          this.$store.state.user = []
          vm.$router.push({path:'/'});
        })
        .catch((errors) => {
          console.log(errors.response);
        });
    },
  },
};
</script>

<style scoped>
</style>
