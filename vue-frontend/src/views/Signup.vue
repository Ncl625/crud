<template>
    <form @submit.prevent="saveUser">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h4>New User</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" v-model="model.user.name" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" v-model="model.user.email" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" v-model="model.user.password" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" v-model="model.user.password_confirmation" class="form-control"/>
                    </div>
                    <div class="submit mb-3">
                        <button type="button" @click="saveUser()" class="btn btn-primary">
                            Create an Account
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
import axios from 'axios'

export default {
    name: 'signup',
    data() {
        return {
            model: {
                user: {
                    name                    :   '',
                    email                   :   '',
                    password                :   '',
                    password_confirmation   :   ''
                }
            }
        }
    },
    methods: {
        saveUser(){
            axios.post('http://127.0.0.1:8000/api/register', this.model.user)
            .then(res => {
                console.log()
                alert(res.data.message)
                
                this.model.user = {
                    name                    :   '',
                    email                   :   '',
                    password                :   '',
                    password_confirmation   :   ''
                }

                this.$router.push({ name: 'login' })

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