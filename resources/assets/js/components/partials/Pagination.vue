<template>
    <div v-show="pagesNumber.length > 1">
        <hr class="my-0 w-100">
        <div class="card-actions align-items-center justify-content-center px-3">
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a class="page-link" href="#" rel="prev"
                            @click.prevent="cambiarPagina(pagination.current_page - 1)">
                            <i class="material-icons">chevron_left</i>
                        </a>
                    </li>
                    <li class="page-item disabled" v-else>
                        <span class="page-link">
                            <i class="material-icons">chevron_left</i>
                        </span>
                    </li>

                    <li class="page-item" v-for="(page, i) in pagesNumber" :key="i"
                        v-bind:class="[ page == isActived ? 'active' : '']">
                        <span class="page-link" v-text="page" v-if="page == isActived"></span>
                        <a class="page-link" href="#" v-text="page" v-else
                            @click.prevent="cambiarPagina(page)"></a>
                    </li>

                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a class="page-link" href="#"
                            @click.prevent="cambiarPagina(pagination.current_page + 1)">
                            <i class="material-icons">chevron_right</i>
                        </a>
                    </li>
                    <li class="page-item disabled" v-else>
                        <span class="page-link">
                            <i class="material-icons">chevron_right</i>
                        </span>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    import {Paginacion} from './../mixins/paginacion';

    export default {
        name: 'Pagination',
        props: {
            paginacion: {
                type: Object,
                required: true,
            },
        },
        created () {
            this.pagination = this.paginacion;
        },
        mixins: [Paginacion],
        methods: {
            cambiarPagina (page) {
                this.pagination.current_page = page;
                this.$emit('nextPage', page);
            }
        },
        computed: {
            isActived () {
                return this.pagination.current_page;
            },
            pagesNumber () {
                if (! this.pagination.to) {
                    return [];
                }

                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }

                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }

                let pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            },
        },
    }
</script>
