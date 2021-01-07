<template>
  <div>
    <!-- ============================footer==================================== -->
    <section class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h6>{{ $t("message.Footer_Right") }}</h6>
            <p class="mt-3 text-justify">
              {{ $t("message.Footer_text") }}
            </p>
          </div>
          <div class="col-md-6 m-auto">
            <div class="row">
              <div class="col-md-4 m-auto">
                <a
                  href=""
                  class="d-block my-2 text-dark font-weight-bold text-decoration-none"
                >
                  {{ $t("message.HOMEPAGE") }}</a
                >
                <a
                  href=""
                  class="d-block my-2 text-dark font-weight-bold text-decoration-none"
                  >{{ $t("message.METIN2_SERVICE") }}</a
                >
                <a
                  href=""
                  class="d-block my-2 text-dark font-weight-bold text-decoration-none"
                  >{{ $t("message.BECOME_A_PARTNER") }}</a
                >
              </div>
              <div class="col-md-4 m-auto">
                <a
                  href=""
                  class="d-block my-2 text-dark font-weight-bold text-decoration-none"
                  >{{ $t("message.PARTNERS") }}</a
                >
                <router-link
                  to="/createserver"
                  class="d-block my-2 text-danger font-weight-bold text-decoration-none"
                  >{{ $t("message.ADD_SERVERS") }}</router-link
                >

                <a
                  href=""
                  class="d-block my-2 text-dark font-weight-bold text-decoration-none"
                  >{{ $t("message.FAQ") }}</a
                >
              </div>
              <div class="col-md-4 m-auto">
                <p class="mb-2 font-weight-bold">
                  {{ $t("message.Find_Us_On") }}
                </p>
                <p>
                  <a
                    href=""
                    class="mx-1 my-2 text-dark font-weight-bold text-decoration-none d-inline"
                  >
                    <img src="/img/fb.png" class="img-fluid" alt="" />
                  </a>
                  <a
                    href=""
                    class="mx-1 my-2 text-dark font-weight-bold text-decoration-none d-inline"
                  >
                    <img src="/img/discord.png" class="img-fluid" alt="" />
                  </a>
                  <a
                    href=""
                    class="mx-1 my-2 text-dark font-weight-bold text-decoration-none d-inline"
                  >
                    <img src="/img/epvp.png" class="img-fluid" alt="" />
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ============================footer==================================== -->

    <!-- ===================bottombar================================== -->
    <section class="bottomBar bg-dark py-2">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <p class="text-secondary">
              {{ $t("message.Footer_text1") }}
              <a href="" class="text-white">trademarks</a>
              {{ $t("message.Footer_text2") }}
              <a href="" class="text-white"> {{ $t("message.Footer_text3") }}</a
              >.
            </p>
          </div>
          <div class="col-md-6 text-right">
            <a href="" class="text-white mr-2">Regulations</a>
            <span>|</span>
            <a href="" class="text-secondary ml-2">Privacy Policy</a>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
</style>
