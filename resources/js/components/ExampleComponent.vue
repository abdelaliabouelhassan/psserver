<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">

                            <input type="text" name="username" v-model="form.username">
                        <span style="color:red" v-if="errors.username">{{this.errors.username[0]}}</span>
                            <input type="email" name="email" v-model="form.email">
                        <span style="color:red" v-if="errors.email">{{this.errors.email[0]}}</span>
                            <input type="password" name="password" v-model="form.password">
                        <span style="color:red" v-if="errors.password">{{this.errors.password[0]}}</span>
                            <input type="password" name="confirmPassword" v-model="form.password_confirmation">

                            <button @click="register"> Register</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
      data(){
          return {
              form:{
                  username:'',
                  password:'',
                  email:'',
                  password_confirmation:''
              },
              errors:[]
          }
      },
        methods:{
            register(){
                this.axios.post('api/register',this.form).then((response) => {
                    this.errors = [];
                    console.log(response)
                }).catch(errors=>{
                    if(errors.response.status == 422){
                            this.errors = errors.response.data.errors;
                    }

                })
            }
        }
    }
</script>
