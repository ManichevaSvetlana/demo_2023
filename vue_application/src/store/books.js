import {defineStore} from 'pinia';
import booksApi from '../api/booksApi';

export const useBooksStore = defineStore('booksStore', {
    state: () => ({
        books: [],
        book: null,
        loading: false,
        pagination: {current_page: 1}
    }),
    actions: {
        async fetch(searchParams = {}, page = 0) {
            this.loading = true;
            try {
                if (!page) searchParams.page = 1;
                else {
                    searchParams.page = this.pagination.current_page + page;
                    if (searchParams.page < 1) searchParams.page = 1;
                    if (searchParams.page > this.pagination.last_page) searchParams.page = this.pagination.last_page;
                }
                const response = await booksApi.get('/books', {params: searchParams});
                this.books = response.data.data;
                this.pagination = response.data.meta;
                this.loading = false;
            } catch (error) {
                console.error('Error while fetching the list of books:', error);
                this.loading = false;
            }
        },
        async get(bookId) {
            this.loading = true;
            try {
                const response = await booksApi.get(`/books/${bookId}`);
                this.book = response.data.data;
                this.loading = false;
            } catch (error) {
                console.error('Error fetching book details:', error);
                this.loading = false;
            }
        }
    }
});
