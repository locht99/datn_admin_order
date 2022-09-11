<template>
    <div class="mt-6">
        <h1 class="page">Trang chủ</h1>
        <div class="main mt-6">
            <div class="form">
                <div class="head">
                    <div
                        class="title text-white h-10 flex justify-between px-4"
                    >
                        <h3>Tổng tiền nạp</h3>
                        <h3>Tổng tiền:</h3>
                    </div>
                    <div class="filter px-2">
                        <input type="date" value="2022-09-20" />
                        <input type="date" value="2022-11-20" />
                        <input type="text" placeholder="Tên tài khoản" />
                        <input type="text" placeholder="Điện thoại" />
                    </div>
                </div>
                <div class="list pt-4 px-4">
                    <span class="empty">Không có giao dịch nạp tiền !</span>
                </div>
            </div>
            <div class="form">
                <div class="head">
                    <div
                        class="title text-white h-10 flex justify-between px-4"
                    >
                        <h3>Tổng đơn hàng</h3>
                        <h3>0 đơn hàng</h3>
                    </div>
                    <div class="filter px-2">
                        <input type="date" value="2022-09-20" />
                        <input type="date" value="2022-11-20" />
                        <input type="text" placeholder="Tên tài khoản" />
                        <input type="text" placeholder="Điện thoại" />
                    </div>
                </div>
                <div class="list p-4">
                    <span class="empty">Không có đơn hàng !</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.page {
    font-weight: 600;
    font-size: 28px;
    line-height: 28px;
    color: #566a7f;
}
.main {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-gap: 35px;
}
.main .form {
    background-color: white;
    border-radius: 10px;
    /* height: 1000px; */
}
.main .form .head {
    box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 10px -10px;
}
.main .form .head .title {
    background-color: #ff3f3a;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
    line-height: 40px;
    font-weight: bold;
}
.main .form .head .filter {
    height: auto;
    line-height: 40px;
    text-align: center;
}
.main .form .head .filter input {
    width: 135px;
    height: 25px;
    border-radius: 5px;
    margin: 0px 5px;
    font-size: 15px;
}
.empty {
    color: #6b6b6b;
    font-style: italic;
}
</style>
