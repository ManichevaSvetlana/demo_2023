import axios from 'axios';

const reviewsApi = axios.create({
    baseURL: "http://localhost:9003/api"
});

export default reviewsApi;
