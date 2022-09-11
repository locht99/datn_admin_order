<template>
    <div class="container m-auto mt-6">
        <div class="flex justify-between items-center">
            <div class="title w-[30%]">
                <p class="font-bold text-[24px] text-gray-600">Tạo mới bao hàng</p>
            </div>
            <div class="search w-[70%]">
                <input type="text"
                    class="w-[100%] rounded border-gray-400 focus:border-gray-400 focus:ring-red-500 block outline-none p-1 duration-300"
                    placeholder="Tìm kiếm">
            </div>
        </div>
        <div class="flex justify-between items-center mt-5">
            <div class="bg-white w-[30%]  rounded">
                <div class="flex justify-between mx-auto items-center p-3 border-b-2 w-[95%]">
                    <div clas="w-[40%]">
                        <p class="text-gray-600 text-[19px]"> Kho hàng</p>
                    </div>
                    <div class="w-[60%]">
                        <select name="" id=""
                            class="w-full p-1 rounded border-gray-400 focus:border-gray-400 focus:ring-gray-400">
                            <option value="">Sài gòn</option>
                        </select>
                    </div>
                </div>
                <div class="form-1">
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Trọng lượng</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch relative">
                                <input type="text"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">KG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Thể tích</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch  relative">
                                <input type="text"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">cm³</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Khối lượng quy đổi</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch  relative">
                                <input type="text"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">KG</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-b w-[95%] mx-auto"></div>
                </div>
                <div class="form-2">
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Đơn giá</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch relative">
                                <input type="text"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Phí đóng gỗ</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch  relative">
                                <input type="text"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Phí khác</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch  relative">
                                <input type="text"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-b w-[95%] mx-auto"></div>
                </div>
                <div class="form-3">
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Đóng gỗ</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch relative">
                                <input type="checkbox"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <!-- <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Thanh toán</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch relative">
                                <input type="checkbox"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <!-- <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Tình trạng</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch  relative">
                               <select class="w-full  rounded border-gray-400 focus:ring-gray-400 text-gray-400">
                                 <option value="">Tình trạng</option>
                               </select>
                            </div>
                        </div>
                    </div>
                    <div class=" flex justify-between mx-auto items-center p-3 ">
                        <div class="w-[40%]">
                            <label for="kg" class="text-gray-600">Phí khác</label>
                        </div>
                        <div class="w-[60%]">
                            <div class="flex flex-wrap items-stretch  relative">
                                <input type="text"
                                    class="flex-shrink flex-grow focus:border-gray-400 focus:ring-gray-400 leading-normal w-[90%] flex-1 border h-10 border-gray-300 rounded rounded-r-none px-3 relative"
                                    placeholder="">
                                <div class="flex -mr-px">
                                    <span class="p-1 flex items-center leading-normal bg-gray-300 rounded rounded-l-none border border-l-0 border-grey-light px-3 whitespace-no-wrap text-white text-sm ">VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-b w-[95%] mx-auto"></div>
                </div>
            </div>
            <div class="w-[70%]">

            </div>
        </div>
    </div>
</template>
<script>

</script>
<style>

</style>