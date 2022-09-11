import AdminLayout from "./layouts/AdminLayout";
import Home from "./components/admin/HomeComponent";
import Order from "./components/admin/OrderComponent";
import Login from "./components/LoginComponent";
import ListTienViet from './components/Admin/Tienviet/ListTienVietComponent.vue';
import ListBaoHang from './components/Admin/BaoHang/ListBaoHangComponent.vue';
import AddBaoHang from './components/Admin/BaoHang/AddBaoHangComponent.vue';
import DonHang from './components/Admin/DonHang/DonHangComponent.vue';
import ChiTietDonHang from './components/Admin/DonHang/ChiTietDonHangComponent.vue';
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
            },
            {
                path: '/donhang',
                component:DonHang
            },
            {
                path: '/chitietdonhang',
                component: ChiTietDonHang
            }
        ],
    },
    {
        path: "/login",
        component: Login,
    },
   

    { path: '/:catchAll(.*)', redirect: '/' },

]
export default routes;

