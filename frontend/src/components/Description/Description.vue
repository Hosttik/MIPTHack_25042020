<template>
    <div>
        <h2 class="mb-2">Заполните данные о человеке на фото</h2>
        <v-app id="inspire">
            <v-flex xs12>
                <v-card class="full-height">
                    <div class="photo-wrap d-inline-block">
                        <div class="origin-photo">
                            <img :src="originImgPath" v-if="originImgPath" class="img-photo"/>
                            <v-progress-circular
                                    v-if="!originImgPath"
                                    :size="70"
                                    :width="7"
                                    color="purple"
                                    indeterminate
                                    class="spinner"
                            ></v-progress-circular>
                        </div>
                    </div>
                    <div class="d-inline-block form_data">
                        <v-form>
                            <v-container>
                                <v-flex>
                                    <v-text-field
                                        v-model="description.last_name"
                                        label="Фамилия"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                        v-model="description.first_name"
                                        label="Имя"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                        v-model="description.middle_name"
                                        label="Отчество"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-text-field
                                        v-model="description.rank"
                                        label="Воинское звание"
                                    ></v-text-field>
                                </v-flex>
                                <v-flex>
                                    <v-textarea
                                        v-model="description.info"
                                        label="Доп. информация"
                                    ></v-textarea>
                                </v-flex>

                                <v-btn @click="upload">Далее</v-btn>
                            </v-container>
                        </v-form>
                    </div>
                </v-card>
            </v-flex>
        </v-app>
    </div>
</template>

<script>
    import { apiHost } from 'src/api/api.utils';
    import showNotify from 'src/helpers/showNotify';
    import showErrors from 'src/helpers/showErrors';
    import getUrl from 'src/helpers/getUrl';
    import { mapMutations } from 'vuex';

    export default {
        name: "Description",
        mounted: async function () {
            const params = {'user_id': localStorage.getItem('memHackUserId')};
            try {
                const res = await apiHost.get('/get-original-file', params);
                const isSuccess = res.is_success;
                if (!isSuccess) {
                    return showErrors(res && res.errors);
                }
                this.originImgPath = getUrl(res.content.file_path);
            } catch (e) {
                showNotify({
                    text: 'Произошла ошибка',
                    type: 'error'
                })
            }
        },
        data: () => ({
            originImgPath: '',
            description: {
                first_name: '',
                last_name: '',
                middle_name: '',
                rank: '',
                info: '',
            },
        }),
        methods: {
          ...mapMutations(['changeLoaderStatus']),
            upload: async function () {
                try {
                  this.changeLoaderStatus({status: true});
                    const res = await apiHost.get('/save-description', {...this.description, 'user_id': localStorage.getItem('memHackUserId')});
                    if (res.is_success) {
                        showNotify({
                            text: 'Данные успешно загружены',
                            type: 'success'
                        });
                        this.changeLoaderStatus({status: false});
                        this.$router.push({path: 'filters'})
                    } else {
                      this.changeLoaderStatus({status: false});
                        showErrors(res.errors);
                    }
                } catch (e) {
                  this.changeLoaderStatus({status: false});
                    showNotify({
                        text: 'Ошибка загрузки данных',
                        type: 'error'
                    })
                }
            },
        }
    }
</script>

<style scoped>
    .full-height {
        height: 550px;
    }

    .photo-wrap {
        padding: 10px;
        width: 50%;
        height: 100%;
        float: left;
        vertical-align: top;
    }

    .origin-photo {
        float: left;
        position: relative;
        width: 600px;
        height: 530px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: grey;
    }

    .form_data {
        float: left;
        width: 40%;
    }

    .img-photo {
        background: grey;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
</style>
