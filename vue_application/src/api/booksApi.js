import axios from 'axios';

const booksApi = axios.create({
    baseURL: "http://localhost:9002/api"
});

export default booksApi;
