import home from './components/home/home.vue';
import profile from './components/profile/profile.vue';
import course from './components/course/course.vue';
import topic from './components/course/topic.vue';
import intake from './components/intake/intake.vue';

export default[
  {path:'/home', component:home},
  {path:'/profile', component:profile},
  {path:'/course', component:course},
  {path:'/topic/:id', component:topic},
  {path:'/intake', component:intake},
]
