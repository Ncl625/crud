<template>
    <form @submit.prevent="loginUser">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>Login to your account</h4>
                </div>
                <div class="card-body">
                    
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" v-model="model.user.email" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" v-model="model.user.password" class="form-control"/>
                    </div>
                    
                    <div class="submit mb-3">
                        <button type="button" @click="loginUser()" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
import axios from 'axios'
import setAuthHeader from '../utils/setAuthHeader'

export default {
    name: 'signup',
    data() {
        return {
            model: {
                user: {
                    email                   :   '',
                    password                :   '',
                    // token                   :   ''
                }
            }
        }
    },
    methods: {
        loginUser(){
            axios.post('http://127.0.0.1:8000/api/login', this.model.user)
            .then(res => {
                if (res.data.success) {
                }
                localStorage.setItem('token',res.data.token)
                // setAuthHeader(res.data.token)
                alert(res.data.message)
                
                this.model.user = {
                    email                   :   '',
                    password                :   '',
                    // token                   :res.data.totken
                }
                // console.log(token)
                
                this.$router.push({ name: 'students' })
                
            })
            .catch(function(error) {
                if (error.response) {
                    console.log(error.response)
                }
            })
        }
    },
}
</script>