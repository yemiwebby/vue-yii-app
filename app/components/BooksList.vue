<template>
  <a-button
      type='primary'
      style='margin-bottom: 8px'
      @click='showAddBookForm'
  >
    Add Book
  </a-button>
  <a-table
      :dataSource='books'
      :columns='columns'
      rowKey='id'
      bordered
  >
    <template #action='{ record }'>
      <div>
        <a-button
            type='primary'
            @click='showBook(record.id)'
            style='margin-right: 5px'
            ghost
        >
          View
        </a-button>
        <a-button
            @click='showEditBookForm(record.id)'
            style='margin-right: 5px'
        >
          Edit
        </a-button>
        <a-popconfirm
            title='Delete book? This action cannot be undone'
            @confirm='deleteBook(record.id)'
            okText='Delete'
            okType='danger'
        >
          <template #icon>
            <WarningOutlined style='color: red'/>
          </template>
          <a-button danger>
            Delete
          </a-button>
        </a-popconfirm>
      </div>
    </template>
  </a-table>
</template>
<script>
import api from '../api';
import {
  PlusOutlined,
  EyeOutlined,
  EditOutlined,
  DeleteOutlined,
  WarningOutlined
} from '@ant-design/icons-vue';

export default {
  components: {
    PlusOutlined,
    EditOutlined,
    EyeOutlined,
    DeleteOutlined,
    WarningOutlined
  },
  data() {
    return {
      books: [],
      columns: [
        {
          title: 'Name',
          dataIndex: 'title',
          key: 'title',
          ellipsis: true
        },
        {
          title: 'Author',
          dataIndex: 'author',
          key: 'author',
        },
        {
          title: 'Release Year',
          dataIndex: 'release_year',
          key: 'release_year',
        },
        {
          title: 'Action',
          key: 'action',
          slots: {customRender: 'action'},
        },
      ]
    };
  },
  methods: {
    async deleteBook(bookId) {
      await api.helpDelete(`books/${bookId}`);
      this.books = this.books.filter(({id}) => id !== bookId);
    },
    showBook(bookId) {
      this.$router.push({name: 'book-item', params: {bookId}});
    },
    showAddBookForm() {
      this.$router.push('/book/add');
    },
    showEditBookForm(bookId) {
      this.$router.push({name: 'book-form', params: {bookId}});
    }
  },
  async mounted() {
    this.books = await api.helpGet('books');
  }
};
</script>
