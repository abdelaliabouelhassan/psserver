<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <input type="text" name="username" v-model="form.username">
                        <span style="color:red" v-if="errors.username">{{this.errors.username}}</span>
                        <input type="password" name="password" v-model="form.password">
                        <span style="color:red" v-if="errors.password">{{this.errors.password[0]}}</span>


                        <button @click="login"> Login</button>
                    </div>

                    <div>
                        <a href="javascript:void(0)" @click="logout">LogOut</a>
                        <a href="javascript:void(0)" @click="testauth">test auth</a>
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
                },
                errors:[]
            }
        },
        methods:{
            testauth(){
                this.axios.get('api/user').then((response) => {
                    console.log(response)
                }).catch(errors=>{
                    console.log(errors.response)
                })
            },
            logout(){
                this.axios.get('api/logout').then((response) => {
                    console.log(response)
                }).catch(errors=>{
                    console.log(errors.response)
                })
            },
            login(){
                this.axios.post('api/login',this.form).then((response) => {
                    this.errors = [];
                    console.log(response)
                    }).catch(errors=>{

                    if(errors.response.status == 422){

                         this.errors = {username:errors.response.data}
                    }

                })
            }
        },

    }
</script>
