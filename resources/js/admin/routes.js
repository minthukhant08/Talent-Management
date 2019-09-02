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
import accessdenied from './components/error/accessdenied.vue';
import superrequired from './components/error/superrequired.vue';
export default[
  {path:'/admin/home', component:home, meta: { requiresAuth: true }},
  {path:'/admin/course', component:course, meta: { requiresAuth: true }},
  {path:'/admin/courseedit/:id', component:courseedit, meta: { requiresAuth: true }},
  {path:'/admin/batch', component:batch, meta: { requiresAuth: true }},
  {path:'/admin/activity', component:activity, meta: { requiresAuth: true }},
  {path:'/admin/topic', component:topic, meta: { requiresAuth: true }},
  {path:'/admin/student', component:student, meta: { requiresAuth: true }},
  {path:'/admin/teacher', component:teacher, meta: { requiresAuth: true }},
  {path:'/admin/scanner', component:scanner, meta: { requiresAuth: true }},
  {path:'/admin/topicedit/:id', component:topicedit, meta: { requiresAuth: true }},
  {path:'/admin/activityedit/:id', component:activityedit, meta: { requiresAuth: true }},
  {path:'/admin/super', component:superadmin, meta: { requiresAuth: true }},
  {path:'/admin/logs', component:log, meta: { requiresAuth: true }},
  {path:'/admin/topicdetail', component:topicdetail, meta: { requiresAuth: true }},
  {path:'/admin/dashboard', component:dashboard, meta: { requiresAuth: true }},
  {path:'/admin/loginrequired', component:accessdenied},
  {path:'/admin/superrequired', component:superrequired}

]
