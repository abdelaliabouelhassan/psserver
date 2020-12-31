<template>
<div>

       <div class="card mt-4 px-3 py-4">
            <table class="table table-striped rounded">
                <thead class="thead-dark bg-dark">
                  <tr>
                    <th>#</th>
                    <th>Servername</th>
                    <th>Votelink</th>
                    <th>Likes</th>
                    <th>Clicks</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="py-5">
                    <td><span class="border bg-white" style="width: 20px !important;height: 20px; border: 1px solid black;">1</span></td>
                    <td>Zuko2</td>
                    <td>https://www.metin2-toplist.info/server/in/1157/</td>
                    <td>
                        <img src="img/like.png" class="img-fluid" alt="">22545
                    </td>
                    <td>
                        <i class="fa fa-external-link-alt text-dark font-10 mr-1"></i>988
                    </td>
                    <td class="text-center">
                        <button class="btn btn-dark px-3 py-0 rounded m-0" style="font-size: 12px;">edit</button>
                    </td>
                  </tr>
                  <tr class="py-5">
                    <td><span class="border py-1 px-2 bg-dark text-white">2</span></td>
                    <td>Zuko2</td>
                    <td>https://www.metin2-toplist.info/server/in/1157/</td>
                    <td>
                        <img src="img/like.png" class="img-fluid" alt="">22545
                    </td>
                    <td>
                        <i class="fa fa-external-link-alt text-dark font-10 mr-1"></i>988
                    </td>
                    <td class="text-center">
                        <button class="btn btn-light px-3 py-0 rounded m-0" style="font-size: 12px;">edit</button>
                    </td>
                  </tr>
                  <tr class="py-5">
                    <td><span class="border py-1 px-2 bg-white">3</span></td>
                    <td>Zuko2</td>
                    <td>https://www.metin2-toplist.info/server/in/1157/</td>
                    <td>
                        <img src="img/like.png" class="img-fluid" alt="">22545
                    </td>
                    <td>
                        <i class="fa fa-external-link-alt text-dark font-10 mr-1"></i>988
                    </td>
                    <td class="text-center">
                        <button class="btn btn-dark px-3 py-0 rounded m-0" style="font-size: 12px;">edit</button>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div class="card py-1 mt-2">
            <div class="text-center">
                <a href="" class="font-weight-bold text-dark text-decoration-none">
                    ADD NEW SERVER
                </a>
            </div>
        </div>
        <button class="btn btn-dark bg-dark btn-block rounded text-white font-14 mt-5">Change your password</button>
        <div class="row mt-4">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="">
                    <input type="text" class="form-control rounded my-3" placeholder="Old password">
                    <input type="password" class="form-control rounded my-3" placeholder="New password">
                    <input type="password" class="form-control rounded my-3" placeholder="Confirm password">
                    <div class="text-center">
                        <input type="submit" class="btn btn-danger rounded font-14 mt-4" value="CHANGE PASSWORD">
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
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
