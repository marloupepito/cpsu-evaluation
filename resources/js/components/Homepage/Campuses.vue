<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 mb-5">
                <center class="h2">All Campuses</center>
            </div>
            <div class="col-md-4 mb-5" v-for="i in rows">
                <v-card prepend-icon="mdi-home">
                    <template v-slot:title>
                        {{ i.campus }}
                    </template>

                    <v-card-text>
                        <v-icon
                            icon="mdi-account-check-outline"
                            size="18"
                            color="success"
                            class="mr-1"
                        ></v-icon>
                        {{ i.name }}
                    </v-card-text>
                    <br />
                   <div class="container mb-5">
                    <div class="row">
                        <div class="col-md-6 col-6">
                            <v-btn
                            block
                            prepend-icon="mdi-qrcode-scan"
                                variant="outlined"
                                color="green"
                                :to="
                                    '/campus/' +
                                    i.campus.replace(/ /g, '_') +
                                    '/' +
                                    'scan?student,'+i.id
                                "
                            >
                            Student
                            </v-btn>
                        </div>
                        <div class="col-md-6 col-6">
                            <v-btn
                            prepend-icon="mdi-qrcode-scan"
                            block
                                variant="outlined"
                                color="green"
                                :to="
                                    '/campus/' +
                                    i.campus.replace(/ /g, '_') +
                                    '/' +
                                    'scan?'+i.id
                                "
                            >
                            Faculty
                            </v-btn>
                        </div>
                    </div>
                   </div>
                </v-card>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            rows: [],
        };
    },
    mounted() {
        this.mount();
    },
    methods: {
        mount() {
            axios.post("/get_all_users").then((res) => {
                this.rows = res.data.status;
                //  this.$swal({
                //    icon: 'success',
                //   title: 'Saved!',
                //    showConfirmButton: false,
                //     timer: 1000
                //   })
            });
        },
    },
};
</script>
