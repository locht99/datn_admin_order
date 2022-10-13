import AdminLayout from "./layouts/AdminLayout";
import Home from "./components/Admin/Home/HomeComponent";
import PayFist from "./components/Admin/PayFist/PayFistComponent"
import User from "./components/Admin/user/UserComponent"
import Partner from "./components/Admin/Partner/PartnerComponent"
import Login from "./components/Auth/LoginComponent";
import ChineseMoney from "./components/Admin/ChineseMoney/ChineseMoneyComponent"
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
        meta: {
            auth:true
        },
        children: [
            {
                path: "/",
                component: Home,
            },
            {
                path: "/home",
                component: Home,
            },
            {
                path:"pay-fist",
                component: PayFist
            },
            {
                path:"user",
                component: User
            },
            {
                path:"Chinese-money",
                component:ChineseMoney
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
            },
            {
                path: '/partner',
                component: Partner
            }
        ],
    },
    {
        path: "/login",
        component: Login,
        meta:{
            auth:false
        }
    },
   

    { path: '/:catchAll(.*)', redirect: '/' },

]
export default routes;

