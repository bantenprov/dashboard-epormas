<template>
    <div>
        <div class="row">
          <div class="col-xl-12 col-lg-12">
            <b-card header="Prosentase" header-tag="h4" class="bg-info-card">
                <b-tabs v-model="tabindex">
                    <b-tab title="Jumlah Laporan">
                      <div class="row" v-model="tahunepormascounter">
                          <h4 class="col-lg-12 mt-3">Tahun {{tahunepormascounter}}</h4>
                          <div class="col-lg-3 col-sm-6 text-center">
                              <b-card class="bg-default-card easy_pie_chart1">
                                  <easy-pie-chart class="easychart" bar-color="#f89a14" scale-color="#f89a14" lineWidth="3" size="90" :percent="countepormascounter">
                                    <span class="percent"><label class="circle_epormascounter" v-model="countepormascounter">{{countepormascounter}} %<span class="d-block">Jumlah</span></label></span>
                                  </easy-pie-chart>
                              </b-card>
                          </div>
                          <div class="col-lg-3  col-sm-6 text-center">
                              <b-card class=" bg-default-card easy_pie_chart3">
                                  <easy-pie-chart class="easychart" bar-color="#09BD8F" scale-color="#09BD8F" lineWidth="3" size="90" :percent="jumlahtotalepormascounter">
                                    <span class="percent"><label class="circle_epormascounter" v-model="totalepormascounter">{{totalepormascounter}}<span class="d-block">Total</span></label></span>
                                  </easy-pie-chart>
                              </b-card>
                          </div>
                          <div class="col-lg-3 col-sm-6 text-center">
                              <b-card class=" bg-default-card easy_pie_chart4">
                                  <easy-pie-chart class="easychart" bar-color="#3a7db5" scale-color="#3a7db5" lineWidth="3" size="90" :percent="totaldataepormascounter">
                                    <span class="percent"><label class="circle_epormascounter" v-model="totaldataepormascounter">{{totaldataepormascounter}} %<span class="d-block">Data</span></label></span>
                                  </easy-pie-chart>
                              </b-card>
                          </div>
                          <div class="col-lg-3 col-sm-6 text-center">
                            <br>
                            <b-progress v-model="countepormascounter" variant="warning" show-progress class="mb-4" animated></b-progress>
                            <b-progress v-model="totalepormascounter" variant="success" show-value class="mb-4" animated> </b-progress>
                            <b-progress v-model="totaldataepormascounter" variant="primary" show-progress class="mb-4" animated></b-progress>
                          </div>
                      </div>
                    </b-tab>
                </b-tabs>
            </b-card>
          </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <b-card header='Grafik' header-tag="h4" class="bg-primary-card">
                    <b-tabs v-model="tabindex">
                        <b-tab title="Jumlah Laporan">
                          <div class="row">
                            <div class="col-lg-12 col-sm-12">
                              <div style="height: 380px;">
                                <IEcharts :option="stacked_epormascounter" :loading="loading" @ready="onReady" ref="areachart"></IEcharts>
                              </div>
                            </div>
                          </div>
                          <div class="row text-center mt-2">
                                <div class="col-sm-12">
                                    <p class="m-0"><b>Tahun </b><b v-model="tahunepormascounter">{{tahunepormascounter}}</b></p>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <p>Jumlah
                                        <br> <b v-model="countepormascounter">{{countepormascounter}} %</b> <b-progress v-model="countepormascounter" variant="warning" show-progress class="mb-4" animated></b-progress></p>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <p>Total
                                        <br> <b v-model="totalepormascounter">{{totalepormascounter}}</b> <b-progress v-model="totalepormascounter" variant="success" show-value class="mb-4" animated> </b-progress></p>
                                </div>
                                <div class="col-sm-4 col-6">
                                    <p>Data
                                        <br> <b v-model="totaldataepormascounter">{{totaldataepormascounter}} %</b> <b-progress v-model="totaldataepormascounter" variant="primary" show-progress class="mb-4" animated></b-progress></p>
                                </div>
                            </div>
                        </b-tab>
                    </b-tabs>
                </b-card>
            </div>
            <div class="col-xl-12 col-lg-12">
                <weather id="5128638"></weather>
            </div>
        </div>
    </div>
</template>
<script>
import Vue from 'vue';
import task from "../components/widgets/task_component/task.vue";
import chat from "../components/widgets/chat_component/chat.vue";
import weather from "../components/widgets/weather/weather.vue";
import IEcharts from 'vue-echarts-v3/src/lite.vue';
import 'echarts/lib/chart/bar';
import 'echarts/lib/chart/line';
import 'echarts/lib/component/legend';
require('swiper/dist/css/swiper.css');


import 'echarts/lib/chart/map';
import 'echarts/lib/chart/treemap';
import 'echarts/lib/chart/graph';
import 'echarts/lib/chart/gauge';
import 'echarts/lib/chart/funnel';
import 'echarts/lib/chart/parallel';
import 'echarts/lib/chart/sankey';
import 'echarts/lib/chart/boxplot';
import 'echarts/lib/component/graphic';
import 'echarts/lib/component/grid';
import 'echarts/lib/component/title';
import 'echarts/lib/component/dataZoom';
import 'echarts/lib/component/visualMap';
import 'echarts/lib/component/markPoint';
import 'echarts/lib/component/markLine';
import 'echarts/lib/component/markArea';
import 'echarts/lib/component/timeline';
import 'zrender/lib/vml/vml';
import 'echarts/lib/chart/pie';

import 'echarts/lib/component/tooltip';
import 'echarts/lib/component/toolbox';
import LinearGradient from 'zrender/lib/graphic/LinearGradient';
import VueAwesomeSwiper from 'vue-awesome-swiper';
import vScroll from "./plugins/scroll/vScroll.vue";
import chat_data from "../assets/js/chat_data";
//import chart from "../assets/js/chart";

import miniToastr from 'mini-toastr';
miniToastr.init();

import Trend from 'vuetrend';
import easyPieChart from "./plugins/easypiechart/easyPieChart.vue"

Vue.use(Trend);
Vue.use(VueAwesomeSwiper);
var unsub;
export default {
    name: "dashboard_epormas",
    components: {
        IEcharts,
        vScroll,
        easyPieChart,
        task,
        chat,
        weather
    },
    data() {
        return {
            tabindex: 0,
            // ========easypiechart
            countepormascounter: 0,
            jumlahtotalepormascounter: 0,
            totaldataepormascounter: 0,
            tahunepormascounter: '',
            totalepormascounter: 0,
            // ========easypiechart
            swiperOption: {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                spaceBetween: 75,
                centeredSlides: true,
                autoplay: 3500,
                autoplayDisableOnInteraction: false,
                loop: false
            },
            instances: [],
            loading: false,
            // ===========main chat=============
            //===========Stacked bar chart start===============
            stacked_epormascounter: {
                title: {
                    text: '',
                    subtext: ''
                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: { //  Axis indicator, coordinate trigger effective
                        type: 'shadow' // The default is a straight line：'line' | 'shadow'
                    }
                },
                legend: {
                    orient: 'horizontal',
                    bottom: 'bottom',
                    data: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H']
                },
                toolbox: {
                    feature: {
                        saveAsImage: {
                            title: "Save"
                        }
                    }
                },
                calculable: true,
                xAxis: [{
                    type: 'category',
                    data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }],
                yAxis: [{
                    type: 'value'
                }],
                series: [{
                    name: 'A',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'B',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'C',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'D',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'E',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'F',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'G',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }, {
                    name: 'H',
                    type: 'bar',
                    stack: '',
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }]
            },
            //===========Stacked bar chart end===============
        }
    },

    methods: {
        onReady(instance) {
            this.instances.push(instance)
        },
    },
    watch: {
        tabindex() {
            setTimeout(() => {
                this.instances.forEach(function(item, index) {
                    setTimeout(function() {
                        item.resize();
                    });
                });
            })
        }
    },
    mounted() {
        unsub = this.$store.subscribe((mutation, state) => {
            if (mutation.type == "left_menu") {
                this.instances.forEach(function(item, index) {
                    setTimeout(function() {
                        //item.resize();
                    });
                });
            }
        });

        var settimes = 12000;
        var settime = settimes*12;
        var time = settimes/8;
        var datachartepormascounter = [];
        axios.get("/dashboard-epormas").then(response => {
          //area_chart epormascounter
          datachartepormascounter = response.data.datachartepormascounter;
          if (datachartepormascounter.datatahun.tahun.length > 0) {
            var countepormascounter = datachartepormascounter.count[0][1][0];
            var tahunpegawaiepormascounter = datachartepormascounter.datatahun.tahun[0]+' Bulan '+datachartepormascounter.namabulans[0]+' '+datachartepormascounter.kota[0].name;
            var totalepormascounter = datachartepormascounter.total[0][1][0];
            var totaldataepormascounter = datachartepormascounter.datatahun.totaldata[0];
            if(totalepormascounter == 0 || countepormascounter == 0){
              var countepormascounter = 0;
            }else {
              var countepormascounter = Math.floor((countepormascounter / totalepormascounter)*100);
            }
            if(totalepormascounter == 0){
              var jumlahtotalepormascounter = 0;
            }else {
              var jumlahtotalepormascounter = Math.floor((totalepormascounter / totalepormascounter)*100);
            }
            if(totalepormascounter == 0 || totaldataepormascounter == 0){
              var totaldataepormascounters = 0;
            }else {
              var totaldataepormascounters = Math.floor((totalepormascounter / totaldataepormascounter)*100);
            }
            this.countepormascounter = countepormascounter;
            this.tahunepormascounter = tahunpegawaiepormascounter;
            this.jumlahtotalepormascounter = jumlahtotalepormascounter;
            this.totaldataepormascounter = totaldataepormascounters;
            this.totalepormascounter = totalepormascounter;

            this.stacked_epormascounter.title.text = 'Jumlah Laporan';
            this.stacked_epormascounter.title.subtext = 'Tahun '+datachartepormascounter.datatahun.tahun[0];
            this.stacked_epormascounter.xAxis[0].data = datachartepormascounter.namabulan;
            var h = 1;
            for (var b = 0; b < datachartepormascounter.kota.length; b++) {
                this.stacked_epormascounter.series[b].data = datachartepormascounter.seriesdata[0].chartdata[0][h];
                this.stacked_epormascounter.series[b].name = ' '+datachartepormascounter.kota[b].name;
                this.stacked_epormascounter.series[b].stack = ' '+datachartepormascounter.kota[b].name;
                this.stacked_epormascounter.legend.data[b] = ' '+datachartepormascounter.kota[b].name;
              h++;
            }
          }
          // //end epormascounter

        })
        .catch(function(error) {miniToastr.error(error, "Error")});

        var p = 1;
        setInterval(() => {
            if(datachartepormascounter.datatahun.tahun.length == 1){
              p=0;
            }
            if (datachartepormascounter.datatahun.tahun.length > 0) {
              this.stacked_epormascounter.xAxis[0].data = datachartepormascounter.namabulan;
              var h = 1;
              for (var b = 0; b < datachartepormascounter.kota.length; b++) {
                  this.stacked_epormascounter.series[b].data = datachartepormascounter.seriesdata[0].chartdata[p][h];
                  this.stacked_epormascounter.series[b].name = ' '+datachartepormascounter.kota[b].name;
                  this.stacked_epormascounter.series[b].stack = ' '+datachartepormascounter.kota[b].name;
                  this.stacked_epormascounter.legend.data[b] = ' '+datachartepormascounter.kota[b].name;
                h++;
              }
            }

            p++;
            if(p==datachartepormascounter.datatahun.tahun.length){
              p=0;
            }
        }, settime);

        var q = 0;
        var r = 0;
        var s = 2;
        var w = 1;
        setInterval(() => {
          if (datachartepormascounter.datatahun.tahun.length > 0) {
            var countepormascounter = datachartepormascounter.count[r][s][q];
            var tahunpegawaiepormascounter = datachartepormascounter.datatahun.tahun[r]+' Bulan '+datachartepormascounter.namabulans[q]+' '+datachartepormascounter.kota[w].name;
            var totalepormascounter = datachartepormascounter.total[r][s][q];
            var totaldataepormascounter = datachartepormascounter.datatahun.totaldata[r];
            if(totalepormascounter == 0 || countepormascounter == 0){
              var countepormascounter = 0;
            }else {
              var countepormascounter = Math.floor((countepormascounter / totalepormascounter)*100);
            }
            if(totalepormascounter == 0){
              var jumlahtotalepormascounter = 0;
            }else {
              var jumlahtotalepormascounter = Math.floor((totalepormascounter / totalepormascounter)*100);
            }
            if(totalepormascounter == 0 || totaldataepormascounter == 0){
              var totaldataepormascounters = 0;
            }else {
              var totaldataepormascounters = Math.floor((totalepormascounter / totaldataepormascounter)*100);
            }
            this.countepormascounter = countepormascounter;
            this.tahunepormascounter = tahunpegawaiepormascounter;
            this.jumlahtotalepormascounter = jumlahtotalepormascounter;
            this.totaldataepormascounter = totaldataepormascounters;
            this.totalepormascounter = totalepormascounter;
          }
            s++;
            w++;
            if(w==datachartepormascounter.kota.length){
              s=1;
              w=0;
                q++;
                if(q==datachartepormascounter.namabulans.length){
                  q=0;
                  r++;
                  if(r==datachartepormascounter.datatahun.tahun.length){
                    r=0;
                  }
                }
            }
        }, time);
    },
    beforeDestroy() {
        unsub();
    }
}
</script>
<style scoped src="../assets/css/index.css"></style>
<style type="text/css">
.index1_swiper .swiper-pagination-bullet-active {
    background: #fff !important;
}
.swiper-widget{
  padding: 7px;

}
.sales-info{
    color: #636c72;
}
.echarts{
    height: 179px !important;
}
/*socio-tabs*/

.socio-tabs {
    min-height: 370px;
    background-color: #F1F5F8;
}

.socio-tabs .tab-content {
    min-height: 315px;
}

.socio-tabs .nav-item a {
    padding: 15px 0;
    text-align: center;
}

.socio-tabs .nav-tabs li:first-child a.active {
    background-color: #55ACEE;
}

.socio-tabs .nav-tabs li:nth-child(2) a.active {
    background-color: #3B5998;
}

.socio-tabs .nav-tabs li:last-child a.active {
    background-color: #3F729B;
}

.socio-tabs .nav-tabs {
    border-top: 3px solid #FFF;
    border-bottom: 0;
}

.socio-tabs .nav-item {
    width: 33.33%;
}

.socio-tabs .nav-tabs .nav-link,
.socio-tabs .nav-tabs .nav-link:focus,
.socio-tabs .nav-tabs .nav-link:hover {
    border-color: #fff #fff #ddd;
    font-size: 14px;
    color: #777;
}

.socio-tabs .nav-tabs .nav-link.active,
.socio-tabs .nav-tabs .nav-item.show .nav-link {
    border-color: #fff #fff #ddd;
    color: #FFF;
}

.tab-pane .card {
    background-color: #F1F5F8;
    border-color: #FFF;
    margin: 0;
}

.tab-pane .card-block {
    padding: 12px;
}

.twitter .tweet-img {
    width: 17%;
}

.twitter .tweet {
    width: 83%;
    padding-left: 3%;
}

a.prfl-link {
    overflow: hidden;
    display: block;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.twitter .tweet .options {
    margin: 0;
}

.twitter .tweet .options i {
    margin-left: 15px;
    cursor: pointer;
}

.facebook .page-img,
.instagram .page-img {
    width: 17%;
}

.facebook .page-name,
.instagram .page-name {
    width: 83%;
    padding-left: 3%;
}
.fb-friends{
    overflow: hidden;
}
.fb-friends img {
    width: 23%;
    margin: 0 0 5px 2px;
    cursor: pointer;
}
.fb-friends img:hover{
    transform: scale(1.1,1.1);
    transition: 300ms
}
.insta-pins .insta-img {
    width: 49%;
    margin: 0 1px;
    float: left;
    position: relative;
}

.insta-pins .insta-img img {
    width: 100%;
    height: 130px;
}

.insta-pins .insta-img .pic-credits {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 3px 7px;
    color: #555;
    background-color: rgba(255, 255, 255, .6);
}

.task1 {
    padding-bottom: 20px!important;
}

.task1 .btn {
    margin-right: 15px!important;
}


/*========chart============*/

#annual-sales {
    position: relative;
    height: 260px;
}

#annual-sales .ct-grid {
    stroke: rgba(0, 0, 0, .07);
    stroke-width: 1px;
    stroke-dasharray: 0;
}

#annual-sales .ct-label {
    color: rgba(0, 0, 0, .7);
    font-size: 1.1rem;
}

#annual-sales .ct-label.ct-horizontal.ct-end {
    margin-left: -15px;
}

@media screen and (max-width:390px) {
    #annual-sales {
        height: 200px;
    }
    #annual-sales .ct-label.ct-horizontal.ct-end {
        transform: rotate(-45deg);
    }
}

#annual-sales .ct-series-a .ct-line,
#annual-sales .ct-series-a .ct-point {
    stroke: #4FC1E9;
}

#annual-sales .ct-series-b .ct-line,
#annual-sales .ct-series-b .ct-point {
    stroke: #09BD8F;
}

#annual-sales .ct-point {
    stroke-width: 7px;
    cursor: pointer;
}

#annual-sales .ct-series-a .ct-area {
    fill: #BFBFC6;
    fill-opacity: .05
}

#annual-sales .ct-series-b .ct-area {
    fill: #4086C1;
    fill-opacity: .05
}

#annual-sales .ct-line {
    stroke-width: 1px
}

.chartist-tooltip {
    background-color: #0a0a0a;
    color: #FFF;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}

.chartist-tooltip:before,
.chartist-tooltip:after {
    content: none;
}

.nav-tabs:focus {
    outline: none;
}



/*======chartist=========*/
</style>
<style scoped lang="scss">
    /*========================easy pie chart========================*/

.easychart {
    & .chart {
        margin: 2px auto;
        position: relative;
        display: inline-block;
        text-align: center;
    }
    .circle_val {
        display: block;
        font-weight: normal;
        color: #333;
        position: relative;
    }
    .percent {
        display: inline-block;
        z-index: 2;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
}
</style>
