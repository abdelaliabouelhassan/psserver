<template>
  <div class="header bg-light m-0 bg-dark">
    <div class="row">
      <div class="col-md-3">
        <div class="logo">
          <a href="index.html">
            <img src="img/logo.png" style="width: 90px" alt="" />
          </a>
        </div>
      </div>
      <div class="col-md-9 d-flex align-items-center">
        <div class="navigation">
          <nav class="vg-nav">
            <ul class="vg-nav-main-container">
              <li>
                <a href="index.html" class="text-white">HOME</a>
              </li>

              <li class="dropdown">
                <a href="" class="text-white">SERVERS</a>
                <ul class="left">
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
                  <li><a href="" class="text-dark">SERVER 4</a></li>
                  <li><a href="" class="text-dark">SERVER 5</a></li>
                  <li><a href="" class="text-dark">SERVER 6</a></li>
                </ul>
              </li>
              <li>
                <a href="" class="text-white">PARTNERS</a>
              </li>
              <li class="dropdown">
                <a href="" class="text-white">FAQ</a>
                <ul class="left">
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
                </ul>
              </li>
              <li>
                <a href="" class="text-white">CONTACT</a>
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
            <img src="img/add-user.png" class="img-fluid" alt="" />
            Create Account
          </a>
          <!-- <a href="" class="btn btn-link text-white
                    hidbtn dropdown-toggle">Sign in</a> -->
          <button class="btn btn-danger ml-2">ADD SERVER</button>
        </p>
        <p class="my-auto headerbtns ml-5" v-if="$store.state.islogin">
          <a
            style="font-size: 0px"
            href=""
            class="btn btn-link text-white hidbtn text-decoration-none"
          >
            <img src="img/Ellipse 1655.png" alt="" />
            <h6>{{ $store.state.user.username }}</h6>
            <br />
            <p class="user-mail dropdown-toggle" style="left: 0px">
              {{ $store.state.user.email }}
            </p></a
          >

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
      login_modal(){
           something.$emit("login_modal");
      },
      login_register(){
            something.$emit("login_register");
      },
    logout() {
      this.axios
        .get("api/logout")
        .then((response) => {
          console.log(response);
          this.$store.state.islogin = false
          this.$store.state.user = []
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
