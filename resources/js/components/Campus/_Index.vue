<template>
	<div>
	<TopNavbar />
		    <SideNavbar/>
		  <v-main>
		    <v-container fluid>
		      <router-view></router-view>
		    </v-container>
		  </v-main>

		  <v-footer app>
		    <!-- -->
		  </v-footer>
	</div>
</template>

<script>
	import SideNavbar from './SideNavbar.vue'
	import TopNavbar from './TopNavbar.vue'
	export default {
		components:{
				SideNavbar,
				TopNavbar
		},
		mounted(){
			
		}
	}
</script>