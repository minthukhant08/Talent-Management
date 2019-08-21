import home from './components/home/home.vue';
 import color from './components/theme/color.vue';
import course from './components/course/course.vue';
import courseedit from './components/course/course-edit.vue';
import batch from './components/batch/batch.vue';
import activity from './components/activity/activity.vue';
import scanner from './components/scanner/scanner.vue';
import student from './components/student/student.vue';
import teacher from './components/teacher/teacher.vue';


export default[
  {path:'/admin/home', component:home},
  {path:'/admin/course', component:course},
  {path:'/admin/courseedit', component:courseedit},
  {path:'/admin/batch', component:batch},
  {path:'/admin/activity', component:activity},
  {path:'/admin/student', component:student},
  {path:'/admin/teacher', component:teacher},
  {path:'/admin/scanner', component:scanner},


]
