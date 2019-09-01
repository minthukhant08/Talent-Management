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
import activitydetail from './components/activity/activitydetail.vue';

export default[
  {path:'/', component:home},
  {path:'/profile/:id', component:profile, meta: { requiresAuth: true }},
  {path:'/editprofile', component:editprofile, meta: { requiresAuth: true }},
  {path:'/activities', component:activities, meta: { requiresAuth: true }},
  {path:'/results', component:results, meta: { requiresAuth: true }},
  {path:'/courses', component:courses, meta: { requiresAuth: true }},
  {path:'/courses/:id', component:topics, meta: { requiresAuth: true }},
  {path:'/giveresults', component:giveresults, meta: { requiresAuth: true }},
  {path:'/assignment', component:assignments, meta: { requiresAuth: true }},
  {path:'/timetable', component:timetable, meta: { requiresAuth: true }},
  {path:'/activitydetail/:id', component:activitydetail, meta: { requiresAuth: true }},

]
