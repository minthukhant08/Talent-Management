import home from './components/home/home.vue';
import profile from './components/userprofile/userprofile.vue';
import editprofile from './components/userprofile/editprofile.vue';
import courses from './components/course/course.vue';
import topics from './components/course/topic.vue';
import activities from './components/activity/activity.vue';
import results from './components/result/result.vue';
import giveresults from './components/give_results/give_results.vue';
import assignments from './components/assignment/assignment.vue';
import timetable from './components/timetable/timetable.vue';
import intake from './components/intake/intake.vue';
import activitydetail from './components/activity/activitydetail.vue';






export default[
  {path:'/', component:home},
  {path:'/profile/:id', component:profile},
  {path:'/editprofile', component:editprofile},
  {path:'/activities', component:activities},
  {path:'/results', component:results},
  {path:'/courses', component:courses},
  {path:'/courses/:id', component:topics},
  {path:'/giveresults', component:giveresults},
  {path:'/assignment', component:assignments},
  {path:'/timetable', component:timetable},
  {path:'/intake', component:intake},
  {path:'/activitydetail/:id', component:activitydetail},

]
