<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h4>
                    Students
                    <RouterLink to="/student/create" class="btn btn-primary float-end">
                        Add Student
                    </RouterLink>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.students.length > 0">
                        <tr v-for="(student, index) in this.students" :key="index">
                            <td> {{ index + 1 }} </td>
                            <td> {{ student.name }} </td>
                            <td> {{ student.course }} </td>
                            <td> {{ student.email }} </td>
                            <td> {{ student.phone }} </td>
                            <td>
                                <RouterLink :to="{ path: '/student/'+student.id+'/edit' }" class="btn btn-success">
                                    Edit
                                </RouterLink>
                            </td>
                            <td>
                                <button type="button" @click="deleteStudent(student.id)" class="btn btn-danger">
                                    Delete
                                </button>

                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7">
                                Loading...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-info" @click = "logout()">Logout</button>
        </div>
    </div>
</template>

<script>
import router from '@/router';
import axios from 'axios'
export default {
    name: 'students',
    data() {
        return {
            students: []
        }
    },
    mounted() {
        this.getStudents();
        // console.log("Mounted")
    },
    methods: {
        getStudents() {

            axios.get('http://127.0.0.1:8000/api/students').then(res => {
                this.students = res.data
                // console.log(this.students)
            });
        },
        deleteStudent(studentId){
            if (confirm('Are you sure, you want to delete this record?')) {
                axios.delete(`http://127.0.0.1:8000/api/students/delete/${studentId}`)
                .then(res => {
                    alert(res.data.message);
                    this.getStudents();
                });
            }
        },
        logout(){
            localStorage.removeItem('token')
            this.$router.push({ name : 'login' })
        }
    },
}

</script>