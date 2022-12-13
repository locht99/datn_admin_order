<template>
    <div class="title">
        <loading v-model:active="is_loading" :is-full-page="false" />
        <h3 class="text-[#566a7f] text-[28px] font-[700]">Cấu hình thông báo</h3>
        <div>
          <div class="flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
            <input :checked="this.noti.is_active==1" id="bordered-radio-1" type="radio" :value="1" v-model="notiStatus" name="notiStatus" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="bordered-radio-1" class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Bật thông báo</label>
          </div>
          <div class="flex items-center pl-4 rounded border border-gray-200 dark:border-gray-700">
              <input :checked="this.noti.is_active==0" id="bordered-radio-2" type="radio" :value="0" v-model="notiStatus" name="notiStatus" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
              <label for="bordered-radio-2" class="py-4 ml-2 w-full text-sm font-medium text-gray-900 dark:text-gray-300">Tắt thông báo</label>
          </div>
        </div>
    </div>
    <div id="editor"></div>
    <button class="ant-btn ant-btn-danger mx-2 my-2" @click="saveNoti()">Thay đổi</button>
  </template>
  
  <script>
  
  import { get } from "../../../services/Noti/noti";
  import { edit } from "../../../services/Noti/noti";
  import Editor from "@toast-ui/editor";
  import "@toast-ui/editor/dist/toastui-editor.css";
  import "@toast-ui/editor/dist/theme/toastui-editor-dark.css";
  import loading from "vue-loading-overlay";
  import "vue-loading-overlay/dist/vue-loading.css";
  export default {
    components: {
        loading,
    },
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title ='Thông báo';
            }
        },
    },
    data() {
      return {
        notiStatus: "",
        noti: [],
        editor: null,
        is_loading: false,
      }
    },
    mounted() {
      this.editor = new Editor({
        el: document.querySelector("#editor"),
        height: "500px",
        initialEditType: "markdown",
        theme: 'white'
      });
      this.getNoti();
    },
    methods: {
        getNoti(){
          this.is_loading = true;
          get()
            .then(res => {
              this.noti = res.data.noti;
              this.notiStatus = this.noti.is_active;
            })
            .catch((error) => {
                this.is_loading = false;
            })
            .finally(() => {
                this.is_loading = false;
            })
        },
        saveNoti(){
          edit({
            id: this.noti.id,
            is_active: this.notiStatus,
          })
          .then(res => {
            return this.$swal.fire('Cập nhập thành công');
            })
            .catch((error) => {
              return this.$swal.fire('Hệ thống đang lỗi vui lòng thử lại sau!');
            })
            .finally(() => {

            })
        }
    }
  }
  </script>
  
  <style>
  </style>
  