<template>
	<div>
		<router-view></router-view>
		<CurvedBottomNavigation
		 foreground-color='green'
		  badge-color='green'
		  icon-color='dark'
  		 :options="options" v-model="selected" />
	</div>
</template>


<script>
  export default {
    data: () => ({
      selected: 2,
      options: [],
    }),
    mounted(){
    
    	this.mount()
    },
    methods:{
    	mount(){
          const campus = window.location.search.substring(1)
        const id = window.location.hash.substring(1)
        this.options =[
        {
          id: 1,
          icon: "fas fa-question text-green",
          title: "How to evaluate",
          path:'/campus/how?'+campus+'#'+id
        },
        { id: 2, 
          icon: "fas fa-home text-green", 
          title: "Home",
          path:'/campus/visit?'+campus+'#'+id
          },
        {
          id: 3,
          icon: "fas fa-qrcode text-green",
          title: "Scan",
          path:'/campus/scan?'+campus+'#'+id
        },
      ]

    		const path = window.location.pathname.split('/')[2]
    		this.selected = path ==='how'?1:path === 'visit'?2:3
    	}
    }
  };
</script>