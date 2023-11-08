<template>
  <div class="flex">
    <!-- Previous Button -->
    <button
        @click="goToPrevPage"
        :disabled="isPrevDisabled"
        :class="{ 'opacity-50 cursor-not-allowed': isPrevDisabled }"
        class="flex items-center justify-center px-4 h-10 mr-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
    >
      <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13 5H1m0 0 4 4M1 5l4-4"/>
      </svg>
      Previous
    </button>
    <button
        @click="goToNextPage"
        :disabled="isNextDisabled"
        :class="{ 'opacity-50 cursor-not-allowed': isNextDisabled }"
        class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
    >
      Next
      <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M1 5h12m0 0L9 1m4 4L9 9"/>
      </svg>
    </button>
  </div>
</template>

<script setup>
import {computed} from 'vue';

const emit = defineEmits(['prev', 'next']);
const props = defineProps({
  pagination: {
    type: Object,
    default: () => ({
      current_page: 1,
      last_page: 1
    })
  }
});

const isPrevDisabled = computed(() => props.pagination.current_page <= 1);
const isNextDisabled = computed(() => props.pagination.current_page >= props.pagination.last_page);

const goToPrevPage = () => {
  console.log(isPrevDisabled.value, props.pagination.current_page <= 1);
  if (!isPrevDisabled.value) {
    emit('prev');
  }
}

const goToNextPage = () => {
  console.log(isPrevDisabled.value, props.pagination.current_page >= props.pagination.last_page);
  if (!isNextDisabled.value) {
    emit('next');
  }
}
</script>

<style scoped>

</style>
