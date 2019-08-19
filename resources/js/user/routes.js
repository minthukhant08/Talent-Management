import home from './components/home/home.vue';
import profile from './components/profile/profile.vue';
import assignment  from './components/assignment/assignment.vue';
import studentlist from './components/student/studentlist.vue';


export default[
  {path:'/home', component:home},
  {path:'/profile', component:profile},
  {path:'/assignment', component:assignment},
  {path:'/student', component:studentlist},
]
