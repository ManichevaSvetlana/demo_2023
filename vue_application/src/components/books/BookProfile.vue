<template>
  <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
    <div>
      <img class="rounded-t-lg w-full h-auto" :src="book.cover" :alt="book.title" />
    </div>
    <div class="p-5">
      <div>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ book.title }}</h5>
      </div>
      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ book.description }}</p>
      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
        <span class="text-base font-normal text-gray-400 dark:text-white"><u>Author</u>: {{ book.author }}</span>
        <br>
        <span class="text-base font-normal text-gray-400 dark:text-white"><u>ISBN</u>: {{ book.isbn }}</span>
        <br>
        <span class="text-base font-normal text-gray-400 dark:text-white"><u>Pages</u>: {{ book.pages }}</span>
      </p>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  book: {
    type: Object,
    required: true,
  },
});
</script>

<style scoped>

</style>
