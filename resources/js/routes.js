import AdminLayout from "./layouts/AdminLayout";
import Home from "./components/admin/HomeComponent";
// import Order from "./components/admin/OrderComponent";
import Login from "./components/LoginComponent";
import ChineseMoney from "./components/admin/ChineseMoneyComponent"
import ListMoneyVietNam from './components/Admin/VietNamese/ListMoneyVietNamComponent.vue';
import ListBag from './components/Admin/Bag/ListBagComponent.vue';
import AddBag from './components/Admin/Bag/AddBagComponent.vue';
import Order from './components/Admin/Order/OrderComponent.vue';
import OrderDetail from './components/Admin/Order/OrderDetailComponent.vue';
import Package from './components/Admin/Order/PackageComponent.vue';
import OrderStatus from './components/Admin/Order/OrderStatusComponent.vue';
import Fee from './components/Admin/Order/FeeComponent.vue'
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
                component: ListMoneyVietNam
            },
            {
                path:'/bag',
                component: ListBag,
            },
            {
                path: '/bag/add',
                component: AddBag
            },
            {
                path: '/order',
                component:Order
            },
            {
                path: '/orderdetail',
                component: OrderDetail
            },
            {
                path: '/orderdetail/package',
                component: Package
            },
            {
                path: '/orderdetail/fee',
                component:Fee
            },
            {
                path: '/orderdetail/status',
                component: OrderStatus
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

