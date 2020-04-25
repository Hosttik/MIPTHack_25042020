<template>
    <div>
        <GSTC :config="config"/>
    </div>
</template>

<script>
  import GSTC from 'vue-gantt-schedule-timeline-calendar';

  export default {
    name: 'Home',
    components: {
      GSTC
    },
    data() {
      return {
        config: {
          height: 1500,
          list: {
            rows: {
              '1': {
                id: '1',
                label: 'Row 1'
              },
              '2': {
                id: '2',
                label: 'Row 2'
              },
              '3': {
                id: '3',
                label: 'Row 3'
              },
              '4': {
                id: '4',
                label: 'Row 4'
              }
            },
            columns: {
              data: {
                id: {
                  id: 'id',
                  data: 'id',
                  width: 50,
                  header: {
                    content: 'ID'
                  }
                },
                label: {
                  id: 'label',
                  data: 'label',
                  width: 200,
                  header: {
                    content: 'Label'
                  }
                }
              }
            }
          },
          chart: {
            items: {
              '1': {
                id: '1',
                rowId: '1',
                label: 'Item 1',
                time: {
                  start: new Date().getTime(),
                  end: new Date().getTime() + 24 * 60 * 60 * 1000
                }
              },
              '2': {
                id: '2',
                rowId: '2',
                label: 'Item 2',
                time: {
                  start: new Date().getTime() + 4 * 24 * 60 * 60 * 1000,
                  end: new Date().getTime() + 5 * 24 * 60 * 60 * 1000
                }
              },
              '3': {
                id: '3',
                rowId: '2',
                label: 'Item 3',
                time: {
                  start: new Date().getTime() + 6 * 24 * 60 * 60 * 1000,
                  end: new Date().getTime() + 7 * 24 * 60 * 60 * 1000
                }
              },
              '4': {
                id: '4',
                rowId: '3',
                label: 'Item 4',
                time: {
                  start: new Date().getTime() + 10 * 24 * 60 * 60 * 1000,
                  end: new Date().getTime() + 12 * 24 * 60 * 60 * 1000
                }
              },
              '5': {
                id: '5',
                rowId: '4',
                label: 'Item 5',
                time: {
                  start: new Date().getTime() + 12 * 24 * 60 * 60 * 1000,
                  end: new Date().getTime() + 14 * 24 * 60 * 60 * 1000
                }
              }
            }
          }
        }
      };
    },
    computed: {},
    methods: {}
  };
</script>

<style scoped>
    .y-axis {
        overflow-x: scroll;
        top: 0;
        height: 50px;
        display: flex;
        left: 0;
        right: 0;
        width: auto;
    }

    .date {
        display: inline-block;
        width: 300px;
    }

    .plot-wrap {

    }

</style>
