import AdminLayout from "./layouts/AdminLayout";
import Home from "./components/admin/HomeComponent";
import Order from "./components/admin/OrderComponent";
import Login from "./components/LoginComponent";
import ListTienViet from './components/Admin/Tienviet/ListTienVietComponent.vue';
import ListBaoHang from './components/Admin/BaoHang/ListBaoHangComponent.vue';
import AddBaoHang from './components/Admin/BaoHang/AddBaoHangComponent.vue';
import DonHang from './components/Admin/DonHang/DonHangComponent.vue';
import ChiTietDonHang from './components/Admin/DonHang/ChiTietDonHangComponent.vue';
import GoiHang from './components/Admin/DonHang/GoiHangComponent.vue';
import TinhTrangDonHang from './components/Admin/DonHang/TinhTrangDonHangComponent.vue';
import TienPhi from './components/Admin/DonHang/TienPhiComponent.vue'
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
                path: '/money-vietnamese',
                component: ListTienViet
            },
            {
                path:'/bag',
                component: ListBaoHang,
            },
            {
                path: '/bag/add',
                component: AddBaoHang
            },
            {
                path: '/order',
                component:DonHang
            },
            {
                path: '/orderdetail',
                component: ChiTietDonHang
            },
            {
                path: '/orderdetail/package',
                component: GoiHang
            },
            {
                path: '/orderdetail/fee',
                component:TienPhi
            },
            {
                path: '/orderdetail/status',
                component: TinhTrangDonHang
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

