<template>
    <v-layout row>
        <v-flex class="full-height" xs3>
            <v-card class="full-height filters"><h1>Фильтры</h1>
                <v-list>
                    <template v-for="filter in filters">
                        <div :key="filter.id" class="filter-wrap">
                            <v-list-tile class="switcher-wrap">
                                <v-switch @change="filterChange" class="switcher" v-model="filter.activate" inset
                                          :label="filter.name"></v-switch>
                            </v-list-tile>
                            <img class="img-filter" :src="filter.path"/>
                        </div>
                    </template>
                </v-list>
            </v-card>
        </v-flex>
        <v-flex xs9>
            <v-card class="full-height">
                <div class="photo-wrap">
                    <div class="origin-photo">
                        <div class="img-text">Оригинал</div>
                        <img :src="originImgPath"  :key='originImgPath' v-if="originImgPath" class="img-photo"/>
                        <v-progress-circular
                                v-if="!originImgPath"
                                :size="70"
                                :width="7"
                                color="purple"
                                indeterminate
                                class="spinner"
                        ></v-progress-circular>
                    </div>

                    <div class="future-photo">
                        <div class="img-text">Результат</div>
                        <img :src="resultImgPath" :key='resultImgPath' v-if="resultImgPath" class="img-photo"/>
                        <v-progress-circular
                                v-if="!resultImgPath"
                                :size="70"
                                :width="7"
                                color="purple"
                                indeterminate
                                class="spinner"
                        ></v-progress-circular>
                    </div>
                </div>
                <v-btn outline
                       class="ma-2"
                       color="indigo"
                       @click="nextScreen"
                >Далее
                </v-btn>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
  import { apiHost } from 'src/api/api.utils';
  import showNotify from 'src/helpers/showNotify';
  import showErrors from 'src/helpers/showErrors';
  import getUrl from 'src/helpers/getUrl';
  import { mapMutations } from 'vuex';

  export default {
    name: 'Filters',
    beforeCreate: async function () {
      const params = {'user_id': localStorage.getItem('memHackUserId')};
      try {
        const res = await apiHost.get('/get-original-file', params);
        const isSuccess = res.is_success;
        if (!isSuccess) {
          return showErrors(res && res.errors);
        }
        const img = getUrl(res.content.file_path);
        this.originImgPath = img;
        this.resultImgPath = img;
      } catch (e) {
        showNotify({
          text: 'Произошла ошибка',
          type: 'error'
        })
      }
      try {
        const res = await apiHost.get('/get-preview-filters', params);
        const isSuccess = res.is_success;
        if (!isSuccess) {
          return showErrors(res && res.errors);
        }
        this.filters = res.content.map(filter => {
          filter.activate = false;
          filter.path = getUrl(filter.path);
          return filter
        });
      } catch (e) {
        showNotify({
          text: 'Произошла ошибка',
          type: 'error'
        })
      }

    },
    data() {
      return {
        originImgPath: '',
        resultImgPath: '',
        timerId: null,
        count:0,
        filters: []
      };
    },
    methods: {
      ...mapMutations(['changeLoaderStatus']),
      nextScreen: function() {
        this.$router.push({path:`finish?params=${this.resultImgPath}`})
      },
      filterChange: async function () {
        if (this.$store.state.loader.status) {
          return;
        }
        if (this.timerId) {
          clearTimeout(this.timerId);
        }
        this.timerId = setTimeout(async () => {
          this.changeLoaderStatus({status: true});
          const filters = this.filters.filter(filter => filter.activate).map(filter => filter.id);
          try {
            const formData = new FormData();
            formData.append('params', JSON.stringify({
              filters,
              user_id: localStorage.getItem('memHackUserId')
            }));
            const res = await apiHost.post(`/use-filters`, formData);
            const isSuccess = res.is_success;
            if (!isSuccess) {
              this.changeLoaderStatus({status: false});
              return showErrors(res.errors);
            }
            this.count++;

            this.resultImgPath = `${getUrl(res.content.file_path)}?counter=${this.count}`;
            this.changeLoaderStatus({
              status: false,
              message: ''
            });
          } catch (e) {
            console.error(e);
            this.changeLoaderStatus({status: false});
            showNotify({
              text: 'Произошла ошибка',
              type: 'error'
            })
          }
        }, 1500);
      }
    }
  }
</script>


<style>
    .full-height {
        height: 100%;
        max-height: 640px;
    }

    .photo-wrap {
        padding-top: 50px;
        width: 100%;
        display: block;
        height: 90%;
        vertical-align: middle;
    }


    .origin-photo {
        float: left;
        position: relative;
        width: 450px;
        height: 480px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: grey;
    }

    .future-photo {
        float: right;
        position: relative;
        width: 450px;
        height: 480px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: grey;
    }

    .img-photo {
        background: grey;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .img-text {
        position: absolute;
        top: -20px;
        left: 0;
        right: 0;
    }

    .filters {
        overflow: scroll;
    }

    .filter-wrap {
        position: relative;
        height: 260px;
    }

    .switcher-wrap {
        position: absolute;
        bottom: 65px;
        background: rgba(115, 115, 115, 0.6);
    }

    .switcher label {
        color: #fff !important;
    }
    .img-filter {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

</style>
