import Parallax from '../Homepage/Parallax.vue'
import CampusesIndex from '../Homepage/_Index.vue'
import Campuses from '../Homepage/Campuses.vue'
import Visit from '../Homepage/Visit.vue'
import Scanner from '../Homepage/Evaluation/Scanner.vue'
import ChooseStudent from '../Homepage/Evaluation/ChooseStudent.vue'
import ChooseFaculty from '../Homepage/Evaluation/ChooseFaculty.vue'
import FacultyScanner from '../Homepage/Evaluation/FacultyScanner.vue'
import EvaluationForm from '../Homepage/Evaluation/Form.vue'
import EvaluationForm2 from '../Homepage/Evaluation/Form2.vue'
import FacultyList from '../Homepage/Evaluation/Faculty.vue'
import FacultyList2 from '../Homepage/Evaluation/Faculty2.vue'

import Administrator from '../Administrator/_Index.vue'
import ADashboard from '../Administrator/Dashboard/_Index.vue'
import ACampuses from '../Administrator/Campuses/_Index.vue'
import ATabs from '../Administrator/Campuses/Tabs.vue'
//import ATable1 from '../Administrator/Campuses/Table.vue'
import AStudents from '../Administrator/Students/_Index.vue'
import ATable1 from '../Administrator/Students/Table.vue'
import AFaculty from '../Administrator/Faculty/_Index.vue'
import ATable2 from '../Administrator/Faculty/Table.vue'
import Loaded from '../Administrator/Faculty/Profile.vue'
import Loading1 from '../Administrator/Faculty/Loading.vue'
import AResults from '../Administrator/Results/_Index.vue'
import ATable3 from '../Administrator/Results/Table.vue'
import Overall from '../Administrator/Results/Overall.vue'
import Print from '../Administrator/Results/Print.vue'
import Print2 from '../Administrator/Results/Print2.vue'
import AQuestionaire from '../Administrator/Questionaire/_Index.vue'

import ATable4 from '../Administrator/Schedule/Calendar.vue'
import ASchedule from '../Administrator/Schedule/_Index.vue'


import Login from '../Auth/Login.vue'
import Logout from '../Auth/Logout.vue'


import Campus from '../Campus/_Index.vue'
import CDashboard from '../Campus/Dashboard/_Index.vue'




const routes =[
	{ path:'/',component:Parallax},
	{ path:'/campuses',component:Campuses },
	{ path:'/login',component:Login },
	{ path:'/logout',component:Logout },
	{ path:'/campus',component:CampusesIndex,
		children:[
			{ path:'/campus',component:Campuses },
			{ path:'/campus/visit',component:Visit },
			{ path:'/campus/:id/scan',component:FacultyScanner },	
			{ path:'/campus/:id/scan2',component:Scanner },	
			{ path:'/campus/:id/choose2',component:ChooseFaculty },	
			{ path:'/campus/:id/choose',component:ChooseStudent },
			{ path:'/campus/:id/faculty',component:FacultyList },	
			{ path:'/campus/:id/faculty2',component:FacultyList2 },
			{ path:'/campus/:id/form',component:EvaluationForm },	
			{ path:'/campus/:id/form2',component:EvaluationForm2 },	
		]
	},
//	{ path:'/evaluation/form',component:EvaluationForm2 },
	{ path:'/administrator',component:Administrator,
		beforeEnter: (to, from, next) => {
            axios.get('/authenticated')
            .then(res=>{
              next()
             
            })
            .catch(err=>{
              return next({ path: '/login'})
            })
          },
		children:[
			{ path:'/administrator',component:ADashboard },
			{ path:'/administrator/campuses',component:ACampuses,
				children:[
					{ path:'/administrator/campuses',component:ATabs },
					{ path:'/administrator/campuses/:id',component:ATabs },
				]
			},{ 
				path:'/administrator/students',component:AStudents,
				children:[
						{ path:'/administrator/students',component:ATabs },
						{ path:'/administrator/students/:id',component:ATabs },
						{ path:'/administrator/students/:id/view',component:ATable1 }
				]
			},{ 
				path:'/administrator/faculty',component:AFaculty,
				children:[
						{ path:'/administrator/faculty',component:ATabs },
						{ path:'/administrator/faculty/:id',component:ATabs },
						{ path:'/administrator/faculty/:id/view',component:ATable2 },
						{ path:'/administrator/faculty/:id/view/loaded',component:Loaded },
						{ path:'/administrator/faculty/campus/view/loading',component:Loading1 }
				]
			},
			{ 
				path:'/administrator/results',component:AResults,
				children:[
						{ path:'/administrator/results',component:ATabs },
						{ path:'/administrator/results/:id',component:ATabs },
						{ path:'/administrator/results/:id/view',component:ATable3 },
						{ path:'/administrator/results/:id/view/overall',component:Overall },
				]
			},
			{ 
				path:'/administrator/schedule',component:ASchedule,
				children:[
						{ path:'/administrator/schedule',component:ATabs },
						{ path:'/administrator/schedule/:id',component:ATabs },
						{ path:'/administrator/schedule/:id/view',component:ATable4 }
				]
			},
			{ path:'/administrator/questionaire',component:AQuestionaire }
		]
	},
	{ path:'/cpsu_campus',component:Campus,
		beforeEnter: (to, from, next) => {
            axios.get('/authenticated')
            .then(res=>{
              next()
             
            })
            .catch(err=>{
              return next({ path: '/login'})
            })
          },
          children:[
          	{path:'/cpsu_campus/:id',component:CDashboard},
          	{path:'/cpsu_campus/students/:id',component:ATable1},
          	{path:'/cpsu_campus/faculty/:id',component:ATable2},
          	{path:'/cpsu_campus/faculty/:id/view/loaded',component:Loaded },
          	{path:'/cpsu_campus/results/:id',component:ATable3},
          	{path:'/cpsu_campus/schedule/:id',component:ATable4},
          	{path:'/cpsu_campus/faculty/campus/view/loading',component:Loading1 },
          	{path:'/cpsu_campus/results/:id/view/overall',component:Overall },
          ]
	},
	
	{ path:'/administrator/results/:id/view/print',component:Print },
	{ path:'/administrator/results/:id/view/print2',component:Print2 },
	
					  {path:'/cpsu_campus/results/:id/view/print',component:Print },
					  {path:'/cpsu_campus/results/:id/view/print2',component:Print2 }


]
export default routes;

