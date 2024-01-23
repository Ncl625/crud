<template>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Edit Student</h4>
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
                    <button type="button" @click="updateStudent()" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';


export default { 
    name: 'studentEdit',
    data() {
        return {
            studentId: '',
            model: {
                student: {
                    name:       '',
                    course:     '',
                    email:      '',
                    phone:      '',
                }
            }
        }
    },
    mounted() {
        this.studentId = this.$route.params.id
        this.getStudentData(this.$route.params.id);
    },
    methods: {
        
        getStudentData(studentId) {
            axios.get(`http://127.0.0.1:8000/api/students/edit/${studentId}`)
            .then(res => {
                // console.log(res.data);

                // this.model.student.name = res.data.name
                // this.model.student.course = res.data.course
                // this.model.student.email = res.data.email
                // this.model.student.phone = res.data.phone

                this.model.student = res.data
            });
        },
        updateStudent(){
            axios.put(`http://127.0.0.1:8000/api/students/update/${this.studentId}`, this.model.student)
            .then(res => {
                // console.log()
                alert(res.data.message)
                
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