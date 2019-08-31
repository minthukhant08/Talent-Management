import home from './components/home/home.vue';

import course from './components/course/course.vue';
import courseedit from './components/course1/course-edit.vue';
import batch from './components/batch/batch.vue';
import activity from './components/activity/activity.vue';
import topic from './components/topic/topic.vue';
import student from './components/student/student.vue';
import scanner from './components/scanner/scanner.vue';
import teacher from './components/teacher/teacher.vue';
import topicedit from './components/topic/topicedit.vue';
import superadmin from './components/super/super.vue';
import log from './components/logs/log.vue';
import activityedit from './components/activity/activity-edit.vue';
import dashboard from './components/dashboard/dashboard.vue';
import topicdetail from './components/topicdetail/topicdetail.vue';
export default[
  {path:'/admin/home', component:home},
  {path:'/admin/course', component:course},
  {path:'/admin/courseedit/:id', component:courseedit},
  {path:'/admin/batch', component:batch},
  {path:'/admin/activity', component:activity},
  {path:'/admin/topic', component:topic},
  {path:'/admin/student', component:student},
  {path:'/admin/teacher', component:teacher},
  {path:'/admin/scanner', component:scanner},
  {path:'/admin/topicedit/:id', component:topicedit},
  {path:'/admin/activityedit/:id', component:activityedit},
  {path:'/admin/super', component:superadmin},
  {path:'/admin/logs', component:log},
  {path:'/admin/topicdetail', component:topicdetail},
  {path:'/admin/dashboard', component:dashboard}
]
