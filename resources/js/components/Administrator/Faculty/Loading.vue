<template>
	<div>
		Loading...
	</div>
</template>

<script>
	export default {
		mounted(){
			this.$router.go(-1)
		}
	}
</script>