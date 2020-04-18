<template>
    <div v-cloak @drop.prevent="addFile" @dragover.prevent class="dropArea">
        <div>
            <h2>Перетащите файл</h2>
            <v-radio-group v-model="nextPath" column>
                <v-radio
                        label="Загрузка фотографии для применении фильтров"
                        color="indigo"
                        value="description"
                ></v-radio>
                <v-radio
                        label="Загрузка фотографии для поиска медалей на фото"
                        color="indigo"
                        value="medals"
                ></v-radio>
            </v-radio-group>
            <div>
                <p>Поддерживаемый формат файла: jpg, jpeg, png.</p>
                <p>Максимальный размер изображения 5 Mb.</p>
            </div>
            <ul>
                <li v-for="file in files">
                    {{ file.name }} {{ file.size }}
                    <button @click="removeFile(file)" title="Remove">X</button>
                </li>
            </ul>

            <v-btn :disabled="uploadDisabled" @click="upload">Загрузить файл</v-btn>
        </div>
    </div>
</template>

<script>

  import { apiHost } from 'src/api/api.utils';
  import showNotify from 'src/helpers/showNotify';
  import showErrors from 'src/helpers/showErrors';
  import { mapMutations } from 'vuex';

  export default {
    name: 'Load',
    data() {
      return {
        nextPath: 'medals',
        files: [],
      };
    },
    computed: {
      uploadDisabled() {
        return this.files.length !== 1;
      }
    },
    methods: {
      ...mapMutations(['changeLoaderStatus']),
      addFile(e) {
        if (this.files.length === 1) {
          return;
        }
        let droppedFiles = e.dataTransfer.files;
        if (!droppedFiles) {
          return;
        }
        ([...droppedFiles]).forEach(f => {
          this.files.push(f);
        });
      },
      removeFile(file) {
        this.files = this.files.filter(f => {
          return f != file;
        });
      },
      upload: async function () {
        this.changeLoaderStatus({
          status: true,
          message: 'Идет загрузка фото...'
        });
        let file = this.files.shift();
        const formData = new FormData();
        formData.append('user_id', localStorage.getItem('memHackUserId'));
        formData.append('file', file);
        formData.append(
          'medals',
          this.nextPath === 'medals'
          ? 1
          : 0);
        try {
          const res = await apiHost.post('/upload-file', formData);
          if (res.is_success) {
            this.changeLoaderStatus({
              status: false,
              message: ''
            });
            showNotify({
              text: 'Картинка успешно загружена',
              type: 'success'
            });
            const content = JSON.stringify(res.content);
            this.$router.push({path: `${this.nextPath}?params=${content}`})
          } else {
            this.changeLoaderStatus({
              status: false,
              message: ''
            });
            showErrors(res && res.errors);
          }
        } catch (e) {
          this.changeLoaderStatus({
            status: false,
            message: ''
          });
          showNotify({
            text: 'Ошибка загрузки файла',
            type: 'error'
          })
        }
      },
    }
  };
</script>

<style scoped>
    .dropArea {
        background-color: #e8ebec;;
        border: 2px dashed #5c6ac0;
        min-height: 400px;
        position: relative;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        display: flex;
    }
</style>
