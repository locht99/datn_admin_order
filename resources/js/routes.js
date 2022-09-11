import AdminLayout from "./layouts/AdminLayout";
import Home from "./components/admin/HomeComponent";
import Order from "./components/admin/OrderComponent";
import Login from "./components/LoginComponent";
import ListTienViet from './components/Admin/Tienviet/ListTienVietComponent.vue';
import ListBaoHang from './components/Admin/BaoHang/ListBaoHangComponent.vue';
import AddBaoHang from './components/Admin/BaoHang/AddBaoHangComponent.vue';
const routes = [
    {
        path: "/",
        component: AdminLayout,
        children: [
            {
                path: "/",
                component: Home,
            },
            {
                path: "/order",
                component: Order
            },
            {
                path: "/login",
                component: Login,
            },
            {
                path: '/tienviet',
                component: ListTienViet
            },
            {
                path:'/baohang',
                component: ListBaoHang,
            },
            {
                path: '/baohang/add',
                component: AddBaoHang
            }
        ],
    },
   

    { path: '/:catchAll(.*)', redirect: '/' },

]
export default routes;

