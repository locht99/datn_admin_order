<template>
    <nav aria-label="Page navigation" class="flex justify-end">
        <ul class="inline-flex -space-x-px pb-2">
            <li
                @click.prevent="
                    pagination.current_page > 1 ? changePage(1) : {}
                "
                class="page-item py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-l border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
            >
                <a class="page-link"
                    ><font-awesome-icon icon="fa-solid fa-backward-step" /></a>
            </li>
            <li
                @click.prevent="
                    pagination.current_page > 1
                        ? changePage(pagination.current_page - 1)
                        : {}
                "
                class="page-item py-2 px-3 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
            >
                <a class="page-link"><font-awesome-icon icon="fa-solid fa-angle-left"></font-awesome-icon></a>
            </li>

            <li
                @click.prevent="
                    pagination.current_page != page ? changePage(page) : {}
                "
                class="page-item py-2 px-3 ml-0 leading-tight border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
                v-for="page in pages"
                :key="page"
                :class="
                    isCurrentPage(page)
                        ? 'bg-gray-200 text-gray-700'
                        : 'text-gray-500 bg-white'
                "
            >
                <a class="page-link"
                    >{{ page }}
                    <span v-if="isCurrentPage(page)" class="sr-only"
                        >(current)</span
                    >
                </a>
            </li>

            <li
                @click.prevent="
                    pagination.current_page < pagination.last_page
                        ? changePage(pagination.current_page + 1)
                        : {}
                "
                class="page-item py-2 px-3 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
            >
                <a class="page-link">
                    <font-awesome-icon icon="fa-solid fa-angle-right" />                </a>
            </li>
            <li
                @click.prevent="
                    pagination.current_page < pagination.last_page
                        ? changePage(pagination.last_page)
                        : {}
                "
                class="page-item py-2 px-3 ml-0 leading-tight text-gray-500 bg-white rounded-r border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer"
            >
                <a class="page-link">
                    <font-awesome-icon icon="fa-solid fa-forward-step" />
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: ["pagination", "offset"],
    methods: {
        isCurrentPage(page) {
            return this.pagination.current_page == page;
        },
        changePage(page) {
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }
            this.$emit("pagination-change-page", page);
        },
    },
    computed: {
        pages() {
            let pages = [];
            let from =
                this.pagination.current_page - Math.floor(this.offset / 2);
            if (from < 1) {
                from = 1;
            }
            let to = from + this.offset - 1;
            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            while (from <= to) {
                pages.push(from);
                from++;
            }
            return pages;
        },
    },
};
</script>
