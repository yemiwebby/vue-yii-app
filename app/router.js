import {createRouter, createWebHistory} from 'vue-router';
import BooksList from './components/BooksList';
import BookItem from './components/BookItem';
import BookForm from './components/BookForm';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'books',
            path: '/',
            component: BooksList,
        },
        {
            name: 'book-form',
            path: '/book/edit/:bookId?',
            component: BookForm,
            props: true,
            alias: '/book/add'
        },
        {
            name: 'book-item',
            path: '/book/:bookId(\\d+)',
            component: BookItem,
            props: true
        },
    ],
});

export default router;
