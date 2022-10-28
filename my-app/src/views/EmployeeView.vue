<template>
    <div class="employee">
        <div class="container col-4 text-start">
            <h2 class="text-center">Employee Registation</h2>
            <div class="form-group mb-4">
                <label>Employee Name</label>
                <input type="text" v-model="employee.name" class="form-control" placeholder="Enter name">
            </div>
            
            <div class="form-group mb-4">
                <label>Employee Email</label>
                <input type="text" v-model="employee.email" class="form-control" placeholder="Enter email">
            </div>
            
            <div class="form-group mb-4">
                <label>Employee Role</label>
                <select v-model="employee.role" class="form-control form-control-sm">
                    <option disabled value="">Please select role</option>
                    <option value="leader">Team leader</option>
                    <option value="developer">Developer</option>
                </select>
            </div>
            
            <button type="submit" @click="create()" class="btn btn-primary">Save</button>
        </div>

        <h2 class="my-5">Employees</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(v,i) in result" :key="i">
                    <th scope="row">{{v.id}}</th>
                    <td>{{v.name}}</td>
                    <td>{{v.email}}</td>
                    <td>{{v.role}}</td>
                    <td>
                        <button type="button" @click="edit(v)" class="btn btn-warning btn-sm me-2">Edit</button>
                        <button type="button" @click="deleteEmp(v.id)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>                
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

    export default {
        name: 'EmployeeView',
        
        data() {
            return {
                result: [],
                employee: {
                    id: '',
                    name: '',
                    email: '',
                    role: ''
                },
            }
        },

        mounted() {
            this.employeeLoad();
        },

        methods: {
            employeeLoad() {
                axios.get('http://127.0.0.1:8000/api/employees')
                .then((res) => {                    
                    this.result = res.data;
                });
            },

            create() {

                if (this.employee.id == '') {

                    axios.post('http://127.0.0.1:8000/api/employees/create', {
                        name: this.employee.name,
                        email: this.employee.email,
                        role: this.employee.role
                    })
                    .then((res) => {
                        console.log(res.data);

                        this.employee.id = '';
                        this.employee.name = '';
                        this.employee.email = '';
                        this.employee.role = '';
                        this.employeeLoad();
                    });  

                } else {
                    this.update();
                }
                              
            },

            edit(employee) {
                this.employee = employee;                
            },

            update() {
                axios.put('http://127.0.0.1:8000/api/employees/update/' + this.employee.id, this.employee)
                .then((res) => {
                    console.log(res.data);

                    this.employee.id = '';
                    this.employee.name = '';
                    this.employee.email = '';
                    this.employee.role = '';
                    this.employeeLoad();
                })
            },

            deleteEmp(id) {
                axios.delete('http://127.0.0.1:8000/api/employees/delete/' + id)
                .then((res) => {
                    console.log(res.data);
                    this.employeeLoad();
                })
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>