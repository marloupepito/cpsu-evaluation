<template>
	<div>
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
	export default {
		components:{
				SideNavbar,
		},
		mounted(){
			
		}
	}
</script>