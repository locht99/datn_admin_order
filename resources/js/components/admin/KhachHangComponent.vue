<template>
    <div class="mt-6">
        <div class=" flex justify-between">
            <h1 class="text-[#566a7f] text-[28px] font-[700]">Khách Hàng</h1>
            <div class="mr-5">
                <img
                 class="w-[32px] h-[32px] cursor-pointer"
                    src="/images/filter.png"
                    alt=""
                />
            </div>
        </div>
       <div class="main mt-6">
          <table class="w-full rounded-t-md overflow-hidden bg-white">
             <thead class="bg-[#FF3F3A] text-white h-[40px] font-bold text-[16px]">
                <tr class="px-2 text-left">
                    <th class="text-center">STT</th>
                    <th class="pl-5">TÊN ĐĂNG NHẬP</th>
                    <th>ĐỊA CHỈ</th>   
                    <th>EMAIL</th>
                    <th>SỐ DIỆN THOẠI</th>
                    <th>SỐ TIỀN</th>
                    <th>NGÀY TẠO</th>
                    <th>TÁC VỤ</th>
                </tr>
             </thead>
             <tbody>
                <tr class="border-solid border-b-[1px] border-[#E2E2E2] h-[52px] font-[16px]">
                    <td class="font-bold text-center">1</td>
                    <td class="pl-5">demo1</td>
                    <td>Hà nội</td>
                    <td>demo@gmail.com</td>
                    <td>123456789</td>
                    <td>1,400,000</td>
                    <td>08-07-22 09:14</td>
                    <td></td>
                </tr>
             </tbody>
          </table>
       </div>
    </div>
</template>

