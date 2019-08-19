import home from './components/home/home.vue';
import color from './components/theme/color.vue';
import student from './components/student/student.vue';
import teacher from './components/teacher/teacher.vue';
import scanner from './components/scanner/scanner.vue';

export default[
  {path:'/admin/home', component:home},
  {path:'/admin/color', component:color},
  {path:'/admin/student', component:student},
  {path:'/admin/scanner', component:scanner},
  {path:'/admin/teacher', component:teacher},
]
