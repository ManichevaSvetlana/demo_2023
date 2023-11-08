import { defineStore } from 'pinia';
import reviewsApi from '../api/reviewsApi';

export const useReviewsStore = defineStore('reviewsStore', {
    state: () => ({
        reviews: [],
    }),
    actions: {
        async fetch(bookId) {
            try {
                const response = await reviewsApi.get(`/books/${bookId}/reviews`);
                this.reviews = response.data.data;
            } catch (error) {
                console.error('Error while fetching reviews:', error);
            }
        },
        async store(bookId, reviewData) {
            try {
                const response = await reviewsApi.post(`/books/${bookId}/reviews`, reviewData);
                this.reviews.unshift(response.data);
                return response.data;
            } catch (error) {
                console.error('Error adding review:', error);
                throw error;
            }
        }
    }
});
