<template>
  <a-spin
      tip='Loading Book'
      v-if='book === null'
  >
  </a-spin>
  <a-card
      hoverable
      style='width: 60%'
      v-else
  >
    <template #cover>
      <img
          alt='example'
          :src='book.cover_image'
      />
    </template>
    <template
        class='ant-card-actions'
        #actions
    >
      <a-button
          @click='showAllBooks'
          type='primary'
          style='margin-right: 5px'
          ghost
      >
        Home
      </a-button>
      <a-button
          @click='showEditBookForm'
          style='margin-right: 5px'
      >
        Edit
      </a-button>
      <a-popconfirm
          title='Delete book? This action cannot be undone'
          @confirm='deleteBook'
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
    </template>
    <a-card-meta
        :title='book.title'
        :description='`Book by ${book.author}`'
    >
      <template #avatar>
        <a-avatar
            src='<https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png>'
        />
      </template>
    </a-card-meta>
    <a-row style='margin-top: 50px'>
      <a-col :span='6'>
        <a-statistic
            title='Release Year'
            groupSeparator=''
            :value='book.release_year'
            style='margin-right: 50px'
        />
      </a-col>
      <a-col :span='18'>
        <a-statistic
            title='IBAN'
            :value='book.iban'
            groupSeparator=''
        />
      </a-col>
    </a-row>
  </a-card>
</template>
<script>
import api from '../api';
import {
  EditOutlined,
  ArrowLeftOutlined,
  WarningOutlined,
  DeleteOutlined
} from '@ant-design/icons-vue';

export default {
  props: ['bookId'],
  data() {
    return {
      book: null
    }
  },
  components: {
    EditOutlined,
    ArrowLeftOutlined,
    WarningOutlined,
    DeleteOutlined
  },
  methods: {
    async loadBook() {
      this.book = await api.helpGet(`books/${this.bookId}`);
    },
    showAllBooks() {
      this.$router.push({name: 'books'});
    },
    showEditBookForm() {
      this.$router.push({name: 'book-form', params: {bookId: this.bookId}});
    },
    async deleteBook() {
      await api.helpDelete(`books/${this.bookId}`);
      this.showAllBooks();
    }
  },
  async mounted() {
    await this.loadBook();
  }
};
</script>
