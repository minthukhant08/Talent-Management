import home from './components/home/home.vue';
import userprofile from './components/userprofile/userprofile.vue';
import edit from './components/userprofile/editprofile.vue';

export default[
  {path:'/home', component:home},
 
  {path:'/userprofile/:id', component:userprofile},
  {path:'/edit/:id', component:edit},
]
  
