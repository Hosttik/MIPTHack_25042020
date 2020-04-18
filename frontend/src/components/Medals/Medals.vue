<template>
    <div>
        <h2 class="mb-2">Информация о наградах</h2>
        <v-app id="inspire">
            <v-flex xs12>
                <v-card class="full-height">
                    <div class="photo-wrap d-inline-block">
                        <div class="origin-photo">
                            <img :src="medalsImgPath" class="img-photo"/>
                        </div>
                    </div>
                    <div class="d-inline-block form_data">
                        <div v-if="medals.length">
                            <h2>{{medalName[currentMedal]}}</h2>
                            <div v-html="medalsDesc[currentMedal]"></div>
                            <div>
                                <template v-for="medal in medals">
                                    <div @click="changeCurrent(medal)" class="medal"
                                         v-bind:class="{ 'active-class': medal === currentMedal }" :key="medal">
                                        <img class="medal-img" :src="getPath(medal)"/>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="not-found" v-if="!medals.length">
                            <h2>Медали не распознаны</h2>
                        </div>
                    </div>
                </v-card>
            </v-flex>
        </v-app>
    </div>
</template>

<script>
  import getUrl from 'src/helpers/getUrl';

  export default {
    name: 'Medals',
    mounted: async function () {
      const params = JSON.parse(this.$route.query.params);
      this.medalsImgPath = getUrl(params.file_path);
      this.medals = params.medals;
      this.currentMedal = params.medals[0];

    },
    methods: {
      getPath: function (medal) {
        return `./${medal}.png`;
      },
      changeCurrent: function (medal) {
        this.currentMedal = medal;
      }
    },
    data: () => ({
      medalsImgPath: '',
      medals: [],
      currentMedal: '',
      medalName: {
        'medal_1': 'За победу на германией',
        'medal_2': 'Золотая звезда героя советского союза',
        'medal_3': 'Орден Отечественной войны'
      },
      medalsDesc: {
        'medal_1': `<p>Медалью «За победу над Германией в Великой Отечественной войне 1941—1945 гг.» награждались:</p>
<ul>
<li>все военнослужащие и лица вольнонаёмного штатного состава, принимавшие непосредственное участие в рядах Красной Армии, Военно-Морского Флота и войск НКВД на фронтах Отечественной войны или обеспечивавшие победу своей работой в военных округах;</li>

<li>все военнослужащие и лица вольнонаёмного штатного состава, служившие в период Великой Отечественной войны в рядах действующей Красной Армии, Военно-Морского Флота и войск НКВД, но выбывшие из них по ранению, болезни и увечью, а также переведённые по решению государственных и партийных организаций на другую работу вне армии.</li>
</ul>

<p>Подробнее <a>https://ru.wikipedia.org/wiki/%D0%9C%D0%B5%D0%B4%D0%B0%D0%BB%D1%8C_%C2%AB%D0%97%D0%B0_%D0%BF%D0%BE%D0%B1%D0%B5%D0%B4%D1%83_%D0%BD%D0%B0%D0%B4_%D0%93%D0%B5%D1%80%D0%BC%D0%B0%D0%BD%D0%B8%D0%B5%D0%B9_%D0%B2_%D0%92%D0%B5%D0%BB%D0%B8%D0%BA%D0%BE%D0%B9_%D0%9E%D1%82%D0%B5%D1%87%D0%B5%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D0%BD%D0%BE%D0%B9_%D0%B2%D0%BE%D0%B9%D0%BD%D0%B5_1941%E2%80%941945_%D0%B3%D0%B3.%C2%BB</a></p>`,
        'medal_2': `<ul>
        <li> Медаль «Золотая Звезда» является знаком отличия лиц, удостоенных высшей степени отличия СССР — звания «Героя Советского Союза».</li>
<li> Медаль «Золотая Звезда» изготавливается из золота и представляет собой пятиконечную звезду с гладкими двугранными лучами на лицевой стороне. Длина луча звезды — 15 мм.</li>
<li>Оборотная сторона медали имеет гладкую поверхность и ограничена по контуру выступающим тонким ободком.</li>
<li> На оборотной стороне в центре медали расположена надпись выпуклыми буквами: «ГЕРОЙ СССР». Размер букв 4×2 мм, в верхнем луче — номер медали, высотой в 1 мм.</li></ul>
<p>
Подробнее <a>https://ru.wikipedia.org/wiki/%D0%9C%D0%B5%D0%B4%D0%B0%D0%BB%D1%8C_%C2%AB%D0%97%D0%BE%D0%BB%D0%BE%D1%82%D0%B0%D1%8F_%D0%97%D0%B2%D0%B5%D0%B7%D0%B4%D0%B0%C2%BB_(%D0%A1%D0%A1%D0%A1%D0%A0)</a></p>
        `,
        'medal_3': `<p>Орденом Отечественной войны награждаются солдаты и начальствующий состав Красной Армии, Военно-Морского Флота, войск НКВД и партизанских отрядов, проявившие в боях за Советскую Родину храбрость, стойкость и мужество, а также военнослужащие, которые своими действиями способствовали успеху боевых операций наших войск. Награждение орденом Отечественной войны производится Указом Президиума Верховного Совета СССР. Орден Отечественной войны состоит из двух степеней: I и II степени. Высшей степенью ордена является I степень. Степень ордена, которым удостаивается награждаемый, определяется Указом Президиума Верховного Совета СССР.</p>

<p>Подробнее <a>https://ru.wikipedia.org/wiki/%D0%9E%D1%80%D0%B4%D0%B5%D0%BD_%D0%9E%D1%82%D0%B5%D1%87%D0%B5%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D0%BD%D0%BE%D0%B9_%D0%B2%D0%BE%D0%B9%D0%BD%D1%8B</a></p>`
      }
    }),
  }
</script>

<style scoped>
    .full-height {
        height: 550px;
    }

    .photo-wrap {
        padding: 20px 0;
        width: 30%;
        height: 100%;
        float: left;
        vertical-align: top;
    }

    .origin-photo {
        width: 100%;
        height: 100%;
        float: left;
        position: relative;
    }

    .form_data {
        float: left;
        width: 70%;
        padding: 20px;
        overflow: hidden;
        height: 100%;
    }

    .img-photo {
        background: grey;
        width: 70%;
        height: 100%;
    }

    .medal {
        display: inline-block;
        width: 200px;
        background-size: cover;
        height: 200px;
        object-fit: cover;
        margin: 5px;
        border: 1px solid black;
    }

    .active-class {
        border: 3px solid red;
    }

    .medal-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .not-found {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }
</style>
