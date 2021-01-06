<template>
  <div class="header bg-light m-0 bg-dark">
    <div class="row"  :class="{'fr':$store.state.lang == 'fr','en':$store.state.lang != 'fr','login':$store.state.islogin && $store.state.lang == 'fr','login_en':$store.state.islogin && $store.state.lang != 'fr'}">
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
                  <router-link to="/home"  class="text-white">{{$t('message.HOME')}}</router-link>
               
              </li>

              <li class="dropdown">
                <a href="" class="text-white">{{$t('message.SERVERS')}}</a>
                <ul class="left">
                  <li><a href="javascript:void(0)" @click="search('')" class="text-dark">{{$t('message.All_Servers')}}</a></li>
                  <li><a href="javascript:void(0)" @click="search('Deutsch')" class="text-dark">Deutsch</a></li>
                  <li><a href="javascript:void(0)" @click="search('English')" class="text-dark">English</a></li>
                  <li><a href="javascript:void(0)" @click="search('Espanol')" class="text-dark">Espanol</a></li>
                    <li><a href="javascript:void(0)" @click="search('France')" class="text-dark">France</a></li>
                    <li><a href="javascript:void(0)" @click="search('Roman')" class="text-dark">Roman</a></li>
                </ul>
              </li>
              <li id="part">
                <a href="" class="text-white">{{$t('message.PARTNERS')}}</a>
              </li>
              <li >
                 <router-link to="/faq"  class="text-white">{{$t('message.FAQ')}}</router-link>
               
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
                 <router-link to="/contact"  class="text-white">{{$t('message.CONTACT')}}</router-link>
            
              </li>
              <li id="last">
                <select name="lang" id="" @change="changeLang" v-model="$store.state.lang" class="form-control d-inline mx-2 langSelect">
                  <option value="en">English</option>
                   <option value="de">Deutsch</option>
                    <option value="fr">French</option>
                     <option value=it>Italy</option>
                     <option value="ro">Roman</option>
                </select>
              </li>
            </ul>
          </nav>
        </div>
        <p class="d-inline my-auto headerbtns" :class="{'fr_headerbtns':$store.state.lang == 'fr'}" v-if="!$store.state.islogin">
          <a
            @click="login_modal"
            class="btn btn-link text-white ml-5 hidbtn dropdown-toggle text-decoration-none"
            
            >{{ $t('message.Sign_in') }}</a
          >|
          <a
            @click="login_register"
            class="btn btn-link text-white hidbtn text-decoration-none"
            
          >
            <img src="/img/add-user.png" class="img-fluid" alt="" />
            {{$t('message.Create_Account')}}
          </a>
          <!-- <a href="" class="btn btn-link text-white
                    hidbtn dropdown-toggle">Sign in</a> -->
         <router-link to="/createserver"  class="btn btn-danger ml-2">{{$t('message.ADD_SERVER')}}</router-link>

        
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
          <button class="btn btn-danger logout" @click="logout">{{$t('message.LOG_OUT')}}</button>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
      
    }
  },
  methods: {
    changeLang(){
      this.$i18n.locale = this.$store.state.lang
       this.axios
        .post("/api/changLang",{lang:this.$store.state.lang})
        .then((response) => {
        })
        .catch((errors) => {
        });
    },
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

.fr{
  margin-left: 4rem;;
}
.en{
  margin-left: 9rem;
}
.fr_headerbtns{
  margin-left: -2rem;
}

.login{
  margin-left: 8rem;
}
.login_en{
  margin-left: 14rem;

}

.langSelect{
    cursor: pointer;
     background-color: black;
    color: white;
    border: black;
    width: 115px
}

@media only screen and (max-width: 1646px){
  .row{
    margin-left: -2rem;
  }

}

@media only screen and (max-width: 1646px){
  .row{
    margin-left: -6rem;
  }

}

@media only screen and (max-width: 1461px){
  .logo{
    margin-left: 8rem;
  }
.row{
      margin-left: -10rem;
}
}

@media only screen and (max-width: 1378px){
  #last{
    display: none;
  }
   .logo{
    margin-left: 0rem;
  }
  .row{
      margin-left: -2rem;
}
}

@media only screen and (max-width: 1378px){
  #last{
    display: none;
  }
   .logo{
    margin-left: 0rem;
  }
  .row{
      margin-left: -2rem;
}
}



@media only screen and (max-width: 1262px){
  
  #last{
    display: none;
  }
   .logo{
   margin-left: -10rem;
  }
  .row{
      margin-left: -4rem;
}


}


@media only screen and (max-width: 1262px){
  .logo{
     margin-left: 1rem;
}

}


@media only screen and (max-width: 1209px) and (max-width: 1218px){
  .row{
    margin-left: 2rem
  }
  #part{
    display: none;
  }
  .logo{
      margin-left: -4rem;
}


}


@media only screen and (max-width: 1199px){
 ul{
   margin-left: 1rem;
 }
  #part{
    display: block;
  }
  #last{
    display: block;
  }


@media only screen and (max-width: 767px){
  .align-items-center{
    margin-bottom: 1rem;
  }
}

@media only screen and (max-width: 474px){
  .navigation{
    margin-bottom: -4rem;
  }
}
@media only screen and (max-width: 475px){
  .navigation{
    margin-left: -4rem;
    margin-top: -2rem;
  }
  .align-items-center{
    margin-bottom: 4rem;
  }
}

}
</style>
