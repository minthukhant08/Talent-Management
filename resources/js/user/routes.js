import home from './components/home/home.vue';
<<<<<<< HEAD
import userprofile from './components/userprofile/userprofile.vue';
import edit from './components/userprofile/editprofile.vue';

export default[
  {path:'/home', component:home},
 
  {path:'/userprofile/:id', component:userprofile},
  {path:'/edit/:id', component:edit},
=======
import profile from './components/profile/profile.vue';
<<<<<<< HEAD
import course from './components/course/course.vue';
import topic from './components/course/topic.vue';
import intake from './components/intake/intake.vue';
=======
import activity from './components/activity/activity.vue';
import result from './components/result/result.vue';
>>>>>>> master

export default[
  {path:'/home', component:home},
  {path:'/profile', component:profile},
<<<<<<< HEAD
  {path:'/course', component:course},
  {path:'/topic/:id', component:topic},
  {path:'/intake', component:intake},
=======
  {path:'/activity', component:activity},
  {path:'/result', component:result},
>>>>>>> f1ae66544a2410e2dd91089ee43c515065916662
>>>>>>> master
]
