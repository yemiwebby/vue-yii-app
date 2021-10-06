<template>
  <a-card
      hoverable
      style='width: 100%'
      :loading='loading'
  >
    <a-form
        :model='book'
        :label-col='labelCol'
        :wrapper-col='wrapperCol'
        :rules='rules'
    >
      <a-form-item
          label='Book title'
          v-bind='validationErrors.title'
      >
        <a-input
            v-model:value='book.title'
        />
      </a-form-item>
      <a-form-item
          label='Author'
          v-bind='validationErrors.author'
      >
        <a-input
            v-model:value='book.author'
        />
      </a-form-item>
      <a-form-item
          label='IBAN'
          v-bind='validationErrors.iban'
      >
        <a-input
            v-model:value='book.iban'
        />
      </a-form-item>
      <a-form-item
          label='Release Year'
          v-bind='validationErrors.release_year'
      >
        <a-input
            v-model:value='book.release_year'
        />
      </a-form-item>
      <a-form-item
          label='Cover Image URL'
          v-bind='validationErrors.cover_image'
      >
        <a-input
            v-model:value='book.cover_image'
        />
      </a-form-item>
      <a-form-item
          :wrapper-col='{ span: 14, offset: 4 }'
      >
        <a-button
            size='large'
            type='primary'
            @click='handleSubmit'
        >
          {{ isEdit ? 'Update' : 'Create' }}
        </a-button>
        <a-button
            size='large'
            style='margin-left: 10px'
            @click='resetFields'
            v-if='!isEdit'
        >
          Reset
        </a-button>
        <a-button
            size='large'
            style='margin-left: 10px'
            @click='showAllBooks'
            danger
        >
          Cancel
        </a-button>
      </a-form-item>
    </a-form>
  </a-card>
</template>
<script>
import api from '../api';
import {Form} from 'ant-design-vue';
import {reactive} from 'vue';
import {useRouter} from 'vue-router'

const {useForm} = Form;

export default {

  setup(props) {
    let book = reactive({
      title: '',
      author: '',
      iban: '',
      release_year: '',
      cover_image: '',
    });

    const rules = reactive({
      title: [
        {
          required: true,
          message: 'Please provide book title',
          trigger: 'blur'
        },
      ],
      author: [
        {
          required: true,
          message: 'Please provide book author',
          trigger: 'blur'
        },
      ],
      iban: [
        {
          required: true,
          message: 'Please provide book IBAN',
          trigger: 'blur'
        },
      ],
      release_year: [
        {
          required: true,
          message: 'Please provide book release year',
          trigger: 'blur'
        },
        {
          length: 4,
          message: 'Length should be 4',
          trigger: 'blur'
        },
      ],
      cover_image: [
        {
          required: true,
          message: 'Please provide url for book cover image',
          trigger: 'blur'
        },
      ],
    });

    const {
      resetFields,
      validate,
      validateInfos: validationErrors
    } = useForm(book, rules);

    const router = useRouter();

    const handleSubmit = () => {
      validate()
          .then(
              async () => {
                const {bookId} = props;
                const updatedBook = !!bookId ?
                    await api.helpPatch(`books/${bookId}`, book) :
                    await api.helpPost('books', book);
                Object.assign(book, updatedBook);
                router.push({name: 'book-item', params: {bookId: book.id}});
              }
          )
          .catch(() => {
          });
    }

    return {
      resetFields,
      validationErrors,
      book,
      handleSubmit,
      rules
    };
  },
  props: ['bookId'],
  data() {
    return {
      isEdit: !!this.bookId,
      loading: !!this.bookId,
      labelCol: {span: 4},
      wrapperCol: {span: 14},
    }
  },
  methods: {
    async loadBook() {
      Object.assign(this.book, await api.helpGet(`books/${this.bookId}`));
      this.loading = false;
    },
    showAllBooks() {
      this.$router.push({name: 'books'});
    },
  },
  async mounted() {
    if (this.isEdit) {
      await this.loadBook();
    }
  }
};
</script>
