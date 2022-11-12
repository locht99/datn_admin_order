<template>
    <li >
        <div class="flex items-center justify-between mb-2 cursor-pointer text-white" @click="toggleShow">
            <font-awesome-icon :icon="[fontAwesome,icon]" />
          {{ title }}
            <svg style="fill: aliceblue;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" :class="{'rotate-90' : showMenu}" 
                class="dropdown-menu " viewBox="0 0 24 24">
                <path fill="none" d="M0 0h24v24H0V0z" />
                <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z" />
            </svg>
        </div>
        <ul class="ml-4 overflow-hidden dropdown-menu font-normal" :class="this.class">
            <slot></slot>
        </ul>
    </li>
</template>
<script>
export default {
    props: ["title", "height",'fontAwesome','icon'],
    data() {
        return {
            showMenu: false
        };
    },

    methods: {
        toggleShow() {
            this.showMenu = !this.showMenu;
        }
    },

    computed: {
        class() {
            return this.showMenu ? this.height : "h-0";
        }
    }
}
</script>
<style>
.dropdown-menu {
  transition: 300ms;
}
svg.rotate-90 {
  transform: rotate(90deg);
}
</style>