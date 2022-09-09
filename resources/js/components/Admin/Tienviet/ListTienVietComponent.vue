<template>
    <div class="container mx-auto">
        <div class="bg-white">
            <div class="flex flex-column">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="flex justify-between items-center px-5">
                        <div class="title mx-5">
                            <p class="text-[#566A7F] text-[23px] font-medium">Tiền Việt</p>
                        </div>
                        <div>
                            <div class="flex justify-between items-center mx-5">
                                <div class="p-3">
                                    <button data-modal-toggle="large-modal"
                                        class="bg-[#E93B3B] hover:bg-orange-800 duration-300 text-white py-1 px-8 rounded ">+
                                        Giao dịch mới</button>

                                </div>
                                <div>
                                    <span class="text-[23px] cursor-pointer">
                                        <button><font-awesome-icon icon="fas fa-sliders-h" /></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-2 inline-block w-screen sm:px-6 lg:px-8">
                        <div class="overflow-hidden rounded-t-[13px]">
                            <table class="min-w-full  border text-center">
                                <thead class=" ">
                                    <tr class="bg-[#FF3F3A]    uppercase leading-normal">
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2 ">
                                            STT
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2 ">
                                            NGÀY
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2 ">
                                            LOẠI
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2">
                                            TÀI KHOẢN
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2">
                                            ĐƠN HÀNG
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2">
                                            GÓI HÀNG
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2">
                                            SỐ TIỀN
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2">
                                            SỐ DƯ
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2">
                                            NỘI DUNG
                                        </th>
                                        <th scope="col" class="text-[14px] font-bold text-white px-7 py-2">
                                            NGÀY TẠO
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b">
                                        <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            25-05-20 03:48
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            Phí kiện hàng
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            Demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            1,446,700
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            HÀ NỘI
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            08-07-22 09:14
                                        </td>

                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            25-05-20 03:48
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            Phí kiện hàng
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            Demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            1,446,700
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            HÀ NỘI
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            08-07-22 09:14
                                        </td>

                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            25-05-20 03:48
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            Phí kiện hàng
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            Demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            1,446,700
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            HÀ NỘI
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            08-07-22 09:14
                                        </td>

                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-6 py-2 whitespace-nowrap text-sm font-bold text-gray-900 ">1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            25-05-20 03:48
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap ">
                                            Phí kiện hàng
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            Demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            demo1
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            1,446,700
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            0
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            HÀ NỘI
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-2 whitespace-nowrap">
                                            08-07-22 09:14
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <AddTienViet/>
</template>
<script>
    import AddTienViet from './AddTienVietComponent.vue';
export default {
    components: {
        AddTienViet
    },
    data() {

    }
}
</script>
<style  scoped>

</style>