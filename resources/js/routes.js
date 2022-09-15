import AdminLayout from "./layouts/AdminLayout";
import Home from "./components/admin/HomeComponent";
import Login from "./components/DangNhapComponent";
import TienHang from "./components/admin/TienHangComponent"
import KhachHang from "./components/admin/KhachHangComponent"

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
                path: "/tien-hang",
                component: TienHang
            },
            {
                path: "/khach-hang",
                component: KhachHang
            },
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
