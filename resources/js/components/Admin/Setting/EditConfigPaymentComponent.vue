<template>
    <div v-show="open"
            class="overflow-x-hidden   overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex	 ease-in-out duration-500">
            <loading v-model:active="isLoading" :color="backGroundcolor" />

            <div class="relative  duration-300 delay-100 ease-in w-auto my-6 mx-auto max-w-6xl">
                <!--content-->
                <div
                    class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    <div class="flex items-start justify-between p-5 border-b border-solid border-slate-200 rounded-t">
                        <h3 class="text-3xl font-semibold">
                            Chỉnh sửa thông tin thanh toán
                        </h3>
                        <button
                            class="p-1 ml-auto bg-transparent border-0 opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                           >
                            <span
                                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none">
                                X
                            </span>
                        </button>
                    </div>
                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        <div class="form-point">
                            <form>
                                <div class="flex items-center justify-center w-full">
                                    <div class="w-full">
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Serec key:</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <textarea name="admin_transactions_point" type="text"
                                                    class="w-full border-gray-300 rounded my-2 px-2 py-1"
                                                   >
                                            </textarea>
                                                <div class="input-errors" 
                                                   >
                                                    <div class="error-msg"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Assecc Key:</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input type="text"
                                                    class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded"
                                                    >
                                                <div class="input-errors"
                                                   >
                                                    <div class="error-msg"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Api End Point:</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input type="text" 
                                                    class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                                <div class="input-errors"
                                                   >
                                                    <div class="error-msg"></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">Suppliter:</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input type="text" 
                                                    class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                                <div class="input-errors"
                                                   >
                                                    <div class="error-msg"></div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="flex items-center w-full">
                                            <div class="w-[30%]">
                                                <label for="">	Partner Code:</label>
                                            </div>
                                            <div class="w-[70%]">
                                                <input type="text" 
                                                    class="w-full border-gray-300 rouned my-2 px-2 py-1 rounded">
                                                <div class="input-errors"
                                                   >
                                                    <div class="error-msg"></div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>

                                    <!--v-if-->

                                </div>
                            </form>
                        </div>
                    </div>
                    <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                        <button
                            class="text-red-500 bg-transparent border border-solid border-red-500 hover:bg-red-500 hover:text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button" v-on:click="$emit('close')">
                            Đóng
                        </button>
                        <button 
                            class=" bg-transparent border border-solid border-red-500 bg-red-500 text-white active:bg-red-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="button">
                            Lưu thay đổi
                        </button>
                    </div>
                </div>
            </div>
    </div>
    <div v-show="open" class="opacity-25 fixed inset-0 z-40 bg-black"></div>

</template>
<script>
export default {
    
    data(){
        return{
        }
    },
    props: {
       open: Boolean
    },
    emits: {
        Actionchild: Boolean,
    },
    methods:{

        
    }
}
</script>
<style lang="">
    
</style>