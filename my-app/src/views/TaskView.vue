<template>
    <div class="task">
        <h1 class="mb-5 text-primary">{{project.name}} project</h1>

        <div class="container col-4 text-start">
            <h2 class="text-center">Create Task</h2>
            <form @submit.prevent="createTask()">
                <div class="mb-3">
                    <label class="form-label">Project Name</label>
                    <input type="text" :value="project.name" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Task Name</label>
                    <input type="text" v-model="task.name" class="form-control" placeholder="Enter task">
                </div>

                <div class="form-group mb-3">
                    <label>Developer</label>
                    <select v-model="task.worker" class="form-control form-control-sm">
                        <option disabled value="">Please select worker</option>
                        <option v-for="(v,i) in worker" :key="i" :value="v.id">{{v.name}}</option>                        
                    </select>
                </div>
        
                <div class="form-group mb-3">
                    <label>Action</label>
                    <select v-model="task.status" class="form-control form-control-sm">
                        <option disabled value="">Please select action</option>
                        <option value="todo">To do</option>
                        <option value="doing">Doing</option>
                        <!-- <option value="done">Done</option> -->
                    </select>
                </div>
        
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>

        <h2 class="my-5">Tasks</h2>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th>Task Name</th>
                    <th>Developer</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(v,i) in result" :key="i">
                    <th scope="row">{{v.id}}</th>
                    <td>{{v.name}}</td>
                    <td>{{v.worker_name}}</td>
                    <td>
                        <select v-model="v.status" @change="changeStatus(v.id,i)" class="form-control form-control-sm w-25 mx-auto">
                            <option disabled value="">Please select action</option>
                            <option value="todo">To do</option>
                            <option value="doing">Doing</option>
                            <option value="done">Done</option>
                        </select>
                    </td>                    
                    <td>                            
                        <button type="button" @click="deleteTask(v.id)" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from "axios";

    export default {
        name: 'TaskView',

        data() {
            return {
                result: [],
                project: {},
                worker: [],
                task: {
                    project_id: '',
                    name: '',
                    worker: '',
                    status: ''
                }
            }
        },

        mounted() {
            this.loadProject();
            this.loadTask();            
        },

        methods: {
            loadProject() {
                let id = this.$route.params.projectId;                

                axios.get('http://127.0.0.1:8000/api/project/' + id)
                .then((res) => {
                    // console.log(res.data.project);
                    this.project = res.data.project;
                    this.task.project_id = this.project.id;

                    this.worker = res.data.worker;
                    // console.log(this.worker);
                });
            },

            loadTask() {
                let id = this.$route.params.projectId;
                
                axios.get('http://127.0.0.1:8000/api/task/' + id)
                .then((res) => {
                    this.result = res.data.task;
                    // console.log(this.result);
                });
            },

            createTask() {
                axios.post('http://127.0.0.1:8000/api/task/create', this.task)
                .then((res) => {
                    console.log(res.data);
                    this.loadTask();
                });
            },

            changeStatus(id,index) {
                
                axios.post('http://127.0.0.1:8000/api/task/status/' + id, {
                    status: this.result[index].status
                })
                .then((res) => {
                    console.log(res.data);
                });
            },

            deleteTask(id) {
                axios.get('http://127.0.0.1:8000/api/task/delete/' + id)
                .then((res) => {
                    console.log(res.data);
                    this.loadTask();
                });
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>