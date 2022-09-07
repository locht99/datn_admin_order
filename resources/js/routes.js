import AdminLayout from "./layouts/AdminLayout";
import Home from "./components/admin/HomeComponent";
import Order from "./components/admin/OrderComponent";
import Login from "./components/LoginComponent";
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
            }
        ],
    },
    {
        path: "/login",
        component: Login,
    },
    {
        path: "/:catchAll(.*)",
        redirect: "/",
    },
];

export default routes;
