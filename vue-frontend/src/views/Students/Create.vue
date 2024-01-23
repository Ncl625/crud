<template>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Add Student</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" v-model="model.student.name" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="course">Course</label>
                    <input type="text" v-model="model.student.course" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" v-model="model.student.email" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="phone">Phone</label>
                    <input type="text" v-model="model.student.phone" class="form-control"/>
                </div>
                <div class="mb-3">
                    <button type="button" @click="saveStudent()" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios'

export default {
    name: 'studentCreate',
    data() {
        return {
            model: {
                student: {
                    name:       '',
                    course:     '',
                    email:      '',
                    phone:      ''
                }
            }
        }
    },
    methods: {
        saveStudent(){
            axios.post('http://127.0.0.1:8000/api/students/create', this.model.student)
            .then(res => {
                console.log()
                alert(res.data.message)
                
                this.model.student = {
                    name:       '',
                    course:     '',
                    email:      '',
                    phone:      ''
                }

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