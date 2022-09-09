import ListTienViet from './components/Admin/Tienviet/ListTienVietComponent.vue';

const routes = [
    {
        path: '/tienviet',
        component: ListTienViet
    },

    { path: '/:catchAll(.*)', redirect: '/' },

]
export default routes;