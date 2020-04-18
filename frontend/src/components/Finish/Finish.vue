<template>
    <v-layout row>
        <v-flex xs4 offset-sm4>
            <v-card>
                <v-img class="img-filter" id="img" :src="imgPath"/>
                <v-card-actions>
                    <v-btn color="indigo" outline @click="download">Скачать</v-btn>
                    <v-spacer></v-spacer>
                    <social-sharing :url="imgPath" inline-template>
                        <div>
                            <network network="facebook">
                                <i class="fa fa-fw fa-facebook"></i>
                            </network>
                            <network network="linkedin">
                                <i class="fa fa-fw fa-linkedin"></i>
                            </network>
                            <network network="pinterest">
                                <i class="fa fa-fw fa-pinterest"></i>
                            </network>
                            <network network="twitter">
                                <i class="fa fa-fw fa-twitter"></i>
                            </network>
                            <network network="vk">
                                <i class="fa fa-vk"></i>
                            </network>
                        </div>
                    </social-sharing>


                </v-card-actions>
            </v-card>
        </v-flex>
    </v-layout>

</template>

<script>
  import showNotify from 'src/helpers/showNotify';
  import showErrors from 'src/helpers/showErrors';
  import { apiHost } from 'src/api/api.utils';
  import { saveAs } from 'file-saver';
  import getUrl from 'src/helpers/getUrl';

  export default {
    name: 'Finish',
    mounted: async function () {
      this.imgPath = this.$route.query.params+'&123';
    },
    async beforeCreate() {
      // const params = {'user_id': localStorage.getItem('memHackUserId')};
      // try {
      //   const res = await apiHost.get('/get-original-file', params);
      //   const isSuccess = res.is_success;
      //   if (!isSuccess) {
      //     return showErrors(res.errors);
      //   }
      //   this.imgPath = getUrl(res.content.file_path);
      // } catch (e) {
      //   showNotify({
      //     text: 'Произошла ошибка',
      //     type: 'error'
      //   })
      // }
    },
    data() {
      return {
        imgPath: ''
      }
    },
    methods: {
      download: function () {
        try {
          saveAs(this.imgPath);
        } catch (e) {
          console.error(e)
        }
      }
    }
  }
</script>

<style scoped>
    .img-filter {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

</style>
