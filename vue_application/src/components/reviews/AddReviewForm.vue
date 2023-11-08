<template>
  <form class="space-y-4" @submit.prevent="storeRating">
    <div>
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Name</label>
      <input type="text" id="name" v-model="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="John Doe" required>
    </div>
    <div>
      <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Comment</label>
      <textarea id="comment" v-model="comment" rows="4" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Leave a comment..." required></textarea>
    </div>
    <div>
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Your Rating</label>
      <div class="flex">
        <template v-for="star in 5" :key="star">
          <svg @click="setRating(star)" :class="{ 'text-gray-300': star > rating, 'text-yellow-400': star <= rating }" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.339-.68 1.283-.68 1.622 0l2.598 5.25a1 1 0 0 0 .751.545l5.801.843a1 1 0 0 1 .553 1.705l-4.2 4.096a1 1 0 0 0-.287.885l.992 5.775a1 1 0 0 1-1.45 1.054L12 19.347l-5.182 2.728a1 1 0 0 1-1.45-1.054l.992-5.775a1 1 0 0 0-.287-.885l-4.2-4.096a1 1 0 0 1 .553-1.705l5.801-.843a1 1 0 0 0 .751-.545l2.598-5.25z"/>
          </svg>
        </template>
      </div>
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
  </form>
</template>

<script setup>
import { ref, defineEmits } from 'vue';

const name = ref('');
const comment = ref('');
const rating = ref(0);

const emit = defineEmits(['store']);

const setRating = (selectedRating) => {
  rating.value = selectedRating;
}

const storeRating = async () => {
  await emit('store', {
    user_name: name.value,
    comment: comment.value,
    rating: rating.value,
  });

  name.value = '';
  comment.value = '';
  rating.value = 0;
}
</script>

<style scoped>

</style>
