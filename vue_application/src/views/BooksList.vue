<template>
  <div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-6 text-center">Our Books</h1>
    <div class="flex justify-center items-center mt-3 mb-6">
      <SearchBooksForm v-model="filters" @search="search"></SearchBooksForm>
    </div>

    <div v-if="bookStore.books && bookStore.books.length > 0 && !bookStore.loading" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <BookItem v-for="book in bookStore.books" :key="book.id" :book="book" class="m-auto"/>
    </div>
    <div v-else-if="!bookStore.loading">
      <p>There are no books so far</p>
    </div>
    <div v-if="bookStore.loading" class="w-full flex items-center justify-center py-[20%]">
      <Loader></Loader>
    </div>

    <div class="flex justify-center items-center pt-12 mb-3" v-if="bookStore.pagination && bookStore.pagination.last_page">
      <Pagination :pagination="bookStore.pagination" @prev="prevPage" @next="nextPage"></Pagination>
    </div>
  </div>
</template>

<script setup>
import {onMounted, reactive} from 'vue';
import {useBooksStore} from '../store/books';
import BookItem from "../components/books/BookItem.vue";
import SearchBooksForm from "../components/books/SearchBooksForm.vue";
import Loader from "../components/Loader.vue";
import Pagination from "../components/books/Pagination.vue";

const bookStore = useBooksStore();
const filters = reactive({
  string: null,
  pagesMin: null,
  pagesMax: null
});

const search = async (data) => {
  filters.string = data.string;
  filters.pagesMin = data.pagesMin;
  filters.pagesMax = data.pagesMax;
  await bookStore.fetch(filters);
}

const prevPage = async () => {
  await bookStore.fetch(filters, -1);
}

const nextPage = async () => {
  await bookStore.fetch(filters, 1);
}

onMounted(async () => {
  await bookStore.fetch();
});
</script>

<style scoped>

</style>
