<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  book: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <router-link :to="{ name: 'BookDetail', params: { bookId: book.id } }">
      <img class="w-full h-auto rounded-t-lg" :src="book.cover" :alt="book.title" />
    </router-link>
    <div class="px-5 pb-5">
      <router-link :to="{ name: 'BookDetail', params: { bookId: book.id } }">
        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ book.title }}</h5>
      </router-link>
      <p class="my-3">
        <span class="text-base font-normal text-gray-400 dark:text-white"><u>Author</u>: {{ book.author }}</span>
        <br>
        <span class="text-base font-normal text-gray-400 dark:text-white"><u>ISBN</u>: {{ book.isbn }}</span>
        <br>
        <span class="text-base font-normal text-gray-400 dark:text-white"><u>Pages</u>: {{ book.pages }}</span>
      </p>
      <div class="flex items-center justify-between">
        <div class="flex items-center mt-2.5 mb-5">
          <svg class="w-4 h-4 mr-1" :class="rate > book.rating ? 'text-gray-200 dark:text-gray-600' : 'text-yellow-300'" v-for="rate in 5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
          </svg>
          <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-3">{{ book.rating }}.0</span>
        </div>
        <router-link :to="{ name: 'BookDetail', params: { bookId: book.id } }" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Leave a review</router-link>
      </div>
    </div>
  </div>

</template>

<style scoped>

</style>
