<template>
    <div class="col-md-6 offset-md-3 col-12 mt-5">

                  <b>Please select peer faculty<small>(ies) including your self.</small>.</b>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Faculty of Name</th>
                    <th scope="col">Choose</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="i in teacher">
                    <th>{{ i.name }}</th>
                    <td>
                        <v-btn
                        prepend-icon="mdi-plus"
                        color="success"
                        size="x-small"
                        @click="checkData(i.id+'|'+i.name+'|'+i.sy+'|'+i.id_number+'|'+i.campus+'|'+i.academic_rank)"
                        >Add</v-btn>
                    </td>
                </tr>
            </tbody>
        </table>
    
        <h3 class="mt-5">Subject List</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Faculty of Name</th>
                    <th scope="col">Subjects</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="i in value">
                    <th scope="row">{{ i.split('|')[1] }}</th>
                    <td>{{ i.split('|')[2] }}</td>
                    <td> <v-btn
                        class="text-white"
                        prepend-icon="mdi-trash-can-outline"
                        color="danger"
                        size="x-small"
                        @click="deleteSubject(i)"
                        >Delete</v-btn></td>
                </tr>
            </tbody>
        </table>
        <v-btn
            color="success"
            :loading="loading"
            class="mt-3"
            @click="validate"
            :disabled="value.length === 0?true:false"
        >
            Start
        </v-btn>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            teacher: [],
            value: [],
            loading: false,
        };
    },
    methods: {
        validate() {
            this.loading=true
           const data =this.value.map(res=>res).map(res =>res.split('|'))
            axios.post('/add_faculty_subject_loading',{
                data:data
            })
            .then(res=>{
                this.loading=false
        this.$router.push({path:'/campus/'+window.location.pathname.split('/')[2]+'/form2'})
            })
        },
        deleteSubject(id){
            const index = this.value.indexOf(id);
            const array = this.value;
            if (index > -1) {
            array.splice(index, 1);
            }
        },  
        checkData(id) {
            function onlyUnique(value, index, self) {
                return self.indexOf(value) === index;
            }

            this.value.push(id);
            var a = this.value;
            var unique = a.filter(onlyUnique);
            this.value = unique;
        },
    },
    mounted() {
        axios
            .post("/get_subject_load_from_teacher2", {
                student: "student",
            })
            .then((res) => {
                this.teacher = res.data.status;
                console.log('dd',res.data.console)
            });
    },
};
</script>
