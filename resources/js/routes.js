import ListTienViet from './components/Admin/Tienviet/ListTienVietComponent.vue';
import Filter from './components/Admin/Tienviet/FilterComponent.vue';

const routes = [
    {
        path: '/tienviet',
        component: ListTienViet
    },
    {
       path: '/filter',
       component: Filter
    },

    { path: '/:catchAll(.*)', redirect: '/' },

]
export default routes;