<script>
	
export default {
	mounted(){
		this.logout()
	},	
	methods: {
		logout(){
			axios.post('/logout')
			.then(res=>{
				this.$router.push({ path:'/login' })
				localStorage.clear()
			})
		},
	}
}
</script>