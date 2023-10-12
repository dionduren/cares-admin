/******/ (() => { // webpackBootstrap
  var __webpack_exports__ = {};
  /*!**********************************************!*\
    !*** ./resources/js/pages/dashboard.init.js ***!
    \**********************************************/
  /*
  Template Name: Dason - Admin & Dashboard Template
  Author: Themesdesign
  Website: https://themesdesign.in/
  Contact: themesdesign.in@gmail.com
  File: Dashboard Init Js File
  */
  // get colors array from the string
  function getChartColorsArray(chartId) {
    var colors = $(chartId).attr('data-colors');
    var colors = JSON.parse(colors);
    return colors.map(function (value) {
      var newValue = value.replace(' ', '');

      if (newValue.indexOf('--') != -1) {
        var color = getComputedStyle(document.documentElement).getPropertyValue(newValue);
        if (color) return color;
      } else {
        return newValue;
      }
    });
  } //  MINI CHART
  // mini-1


  var barchartColors = getChartColorsArray("#mini-chart1");
  var options = {
    series: [61, 89],
    labels: ['Request', 'Incident'],
    chart: {
      type: 'donut',
      height: 200
    },
    colors: barchartColors,
    legend: {
      show: false
    },
    dataLabels: {
      enabled: false
    }
  };
  var chart = new ApexCharts(document.querySelector("#mini-chart1"), options);
  chart.render(); // mini-2

  var barchartColors = getChartColorsArray("#mini-chart2");
  var options = {
    series: [5, 50, 95],
    labels: ['Waiting', 'Assigned', 'Finished'],
    chart: {
      type: 'pie',
      height: 200
    },
    colors: barchartColors,
    legend: {
      show: false
    },
    dataLabels: {
      enabled: false
    }
  };
  var chart = new ApexCharts(document.querySelector("#mini-chart2"), options);
  chart.render(); // mini-3


})()
  ;