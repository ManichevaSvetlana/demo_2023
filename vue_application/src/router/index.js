import { createRouter, createWebHistory } from 'vue-router';
import BooksList from '../views/BooksList.vue';
import BookDetail from '../views/BookDetail.vue';

const routes = [
    {
        path: '/',
        name: 'BooksList',
        component: BooksList
    },
    {
        path: '/books/:bookId',
        name: 'BookDetail',
        component: BookDetail,
        props: true
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});

export default router;
