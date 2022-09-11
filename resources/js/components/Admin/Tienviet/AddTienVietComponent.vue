<template>
<div id="large-modal" tabindex="-1"
        class="hidden   overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
        <div class="relative  p-4 w-full max-w-4xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-center p-5 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Nạp tiền, điều chỉnh
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="large-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="form-point my-4 mx-4">
                    <form>
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <div><label for="">Loại giao dịch</label><select name="admin_transactions[type_id]"
                                        id="admin_transactions_type"
                                        class="w-full border-gray-300 rounded my-2 px-2 py-1">
                                        <option value="0"> -- Chọn loại giao dịch -- </option>
                                        <option value="2">Thanh toán</option>
                                        <option value="3">Phí kho</option>
                                        <option value="4">Phí vận chuyển</option>
                                        <option value="5">Chi phí nhân viên</option>
                                        <option value="6">Khác</option>
                                    </select>
                                    <!--v-if-->
                                </div>
                                <div class="relative"><label for="">Ngày</label><input name="admin_transactions[date]"
                                        type="text"
                                        class="w-full border-gray-300 rounded my-2 px-2 py-1 bg-gray-100"></div>
                                <div><label for="">Số tiền</label><input name="admin_transactions_point" type="text"
                                        class="w-full border-gray-300 rounded my-2 px-2 py-1"></div>
                                <!--v-if-->
                            </div>
                            <div>
                                <div><label for="">Nội dung</label><textarea name="admin_transactions[content]"
                                        class="w-full border-gray-300 rounded my-2 px-2 py-1"></textarea>
                                    <!--v-if-->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="my-2"><button type="submit"
                                class="my-4 bg-red-600 hover:bg-red-800 text-white px-2 py-2 w-full rounded-md"
                                id="submit-point"><span class="spinner-border spinner-border-sm d-none" role="status"
                                    aria-hidden="true"></span> Tạo mới </button></div>
                    </form>
                </div>
                <!-- Modal footer -->
             
            </div>
        </div>
    </div>
</template>