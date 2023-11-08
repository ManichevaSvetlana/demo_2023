<template>
  <div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-6">Book's Details</h1>
    <div v-if="book" class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <BookProfile :book="book" class="m-auto pb-6 mt-0"></BookProfile>
      <div>
        <ReviewsList :reviews="reviews">
          <AddReviewForm @store="storeReview" class="mb-4"></AddReviewForm>
        </ReviewsList>
      </div>
    </div>
    <div v-else>
      <p>Loading...</p>
    </div>
  </div>
</template>

<script setup>
import {computed, onMounted} from 'vue';
import { useRoute } from 'vue-router';
import { useBooksStore } from '../store/books';
import { useReviewsStore } from '../store/reviews';
import BookProfile from "../components/books/BookProfile.vue";
import ReviewsList from "../components/reviews/ReviewsList.vue";
import AddReviewForm from "../components/reviews/AddReviewForm.vue";

const route = useRoute();
const booksStore = useBooksStore();
const reviewsStore = useReviewsStore();

const book = computed(() => booksStore.book);
const reviews = computed(() => reviewsStore.reviews);

const storeReview = async (data) => {
  await reviewsStore.store(route.params.bookId, data);
}

onMounted(async () => {
  await booksStore.get(route.params.bookId);
  await reviewsStore.fetch(route.params.bookId);
});
</script>

<style scoped>

</style>
