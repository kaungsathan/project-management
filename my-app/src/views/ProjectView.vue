<template>
    <div class="project">
        <div class="container col-4 text-start">
            <h2 class="text-center">Create Project</h2>
            <form @submit.prevent="createProject()">
                <div class="mb-3">
                    <label class="form-label">Project Name</label>
                    <input type="text" v-model="project.name" class="form-control" placeholder="Enter name">                    
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Developer</label>
                    <input type="number" v-model="project.worker_count" class="form-control" placeholder="Enter total developer">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deadline</label>
                    <input type="date" v-model="project.dead_line" class="form-control">
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <h2 class="my-5">Projects</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Project Name</th>
                    <th>Total Developer</th>
                    <th>Deadline</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(v,i) in result" :key="i">
                    <th scope="row">{{v.id}}</th>
                    <td>{{v.name}}</td>
                    <td>{{v.worker_count}}</td>                    
                    <td v-if="v.dead_line">{{ dateTime(v.dead_line) }}</td>
                    <td v-else>none</td>
                    <td>
                        <button type="button" @click="goTask(v.id)" class="btn btn-success btn-sm me-2">Assign</button>
                        <button type="button" @click="edit(v)" class="btn btn-warning btn-sm me-2">Edit</button>
                        <button type="button" @click="deleteProject(v.id)" class="btn btn-danger btn-sm">Delete</button>                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment";



    export default {
        name: 'ProjectView',

        data() {
            return {
                result: [],
                project: {
                    id: '',
                    name: '',
                    worker_count: '',
                    dead_line: ''
                }
            }
        },

        mounted() {
            this.loadProject();
        },

        methods: {

            dateTime(value) {
                return moment(value).format('MM-DD-YYYY');
            },

            loadProject() {
                axios.get('http://127.0.0.1:8000/api/project')
                .then((res) => {                    
                    this.result = res.data;                    
                });
            },

            createProject() {
                
                if (this.project.id) {
                    this.updateProject();
                } else {
                    axios.post('http://127.0.0.1:8000/api/project/create', this.project)
                    .then((res) => {
                        console.log(res.data);

                        this.project.id = '';
                        this.project.name = '';
                        this.project.worker_count = '';
                        this.project.dead_line = '';                        
                        this.loadProject();
                    });
                }
                
            },

            edit(project) {
                this.project = project;
                // console.log(this.project);
            },

            updateProject() {
                axios.post('http://127.0.0.1:8000/api/project/update/' + this.project.id, this.project)
                .then((res) => {
                    console.log(res.data);
                    this.project.id = '';
                    this.project.name = '';
                    this.project.worker_count = '';
                    this.project.dead_line = '';

                    this.loadProject();
                });
            },

            deleteProject(id) {
                axios.get('http://127.0.0.1:8000/api/project/delete/' + id)
                .then((res) => {
                    console.log(res.data);
                    this.loadProject();
                });
            },

            goTask(id) {
                this.$router.push({
                    name: 'task',
                    params: {
                        projectId: id
                    }
                });
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>