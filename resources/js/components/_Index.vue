<template>
    <v-app>
        <router-view></router-view>
    </v-app>
</template>

<script>
    export default {
        components:{
        },
        mounted() {
            const path = window.location.pathname.split('/')[1]
            if(path === 'administrator' && localStorage.getItem("academic_rank") !== 'Main Administrator Campus'){
                this.$router.push({path:'/logout'})
            }else if(path === 'cpsu_campus' && localStorage.getItem("academic_rank") !== 'Campus Administrator'){
               this.$router.push({path:'/logout'}) 
            }
        }
    }
</script>
