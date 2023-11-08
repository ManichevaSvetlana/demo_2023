<template>
  <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center justify-between mb-4">
      <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Reviews</h5>
    </div>
    <slot></slot>
    <div class="flow-root">
      <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
        <li class="py-3 sm:py-4" v-for="review in reviews">
          <div class="flex items-center space-x-4">
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                {{ review.user_name }}
              </p>
              <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                {{ review.comment }}
              </p>
            </div>
            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
              {{ review.rating }} / 5
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>

</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  reviews: {
    type: Array,
    required: true,
  },
});
</script>

<style scoped>

</style>
