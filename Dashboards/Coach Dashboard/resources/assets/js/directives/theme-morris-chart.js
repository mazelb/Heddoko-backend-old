/**
 *
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 *
 * @brief   Transfered and adapted from Admin Box Theme by Joao Garin
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    January 2016
 */
angular.module('app.directives')

.directive('themeMorrisChart', [function() {
    return {
        scope: {
            data: "="
        },
        link: function(scope, ele, attrs) {
            var colors, data, func, options,chart;
            switch (data = scope.data, attrs.type)
            {
                case 'line':
                    return colors = void 0 === attrs.lineColors || "" === attrs.lineColors ? null : JSON.parse(attrs.lineColors),
                        options = {
                            element: ele[0],
                            data: data,
                            xkey: attrs.xkey,
                            ykeys: JSON.parse(attrs.ykeys),
                            hideHover: 'always',
                            labels: JSON.parse(attrs.labels),
                            lineWidth: attrs.lineWidth || 2,
                            lineColors: colors || ["#0b62a4", "#7a92a3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"],
                            pointSize: attrs.pointSize || 0,
                            postUnits: attrs.postUnits || '',
                            verticalGrid: true
                        },
                        chart = new Morris.Line(options);
                case 'area':
                    return colors = void 0 === attrs.lineColors || "" === attrs.lineColors ? null : JSON.parse(attrs.lineColors), options = {
                        element: ele[0],
                        data: data,
                        xkey: attrs.xkey,
                        ykeys: JSON.parse(attrs.ykeys),
                        labels: JSON.parse(attrs.labels),
                        lineWidth: attrs.lineWidth || 2,
                        lineColors: colors || ["#0b62a4", "#7a92a3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"],
                        behaveLikeLine: attrs.behaveLikeLine || !1,
                        fillOpacity: attrs.fillOpacity || "auto",
                        pointSize: attrs.pointSize || 4
                    }, chart = new Morris.Area(options),$(window).resize(function(){
                        chart.redraw();
                    });
                case "bar":
                    return colors = void 0 === attrs.barColors || "" === attrs.barColors ? null : JSON.parse(attrs.barColors), options = {
                        element: ele[0],
                        data: data,
                        xkey: attrs.xkey,
                        ykeys: JSON.parse(attrs.ykeys),
                        labels: JSON.parse(attrs.labels),
                        barColors: colors || ["#0b62a4", "#7a92a3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"],
                        stacked: attrs.stacked || null
                    }, chart = new Morris.Bar(options),$(window).resize(function(){
                        //chart.redraw();
                    });
                case "donut":
                    /*jslint evil: true */
                    return colors = void 0 === attrs.colors || "" === attrs.colors ? null : JSON.parse(attrs.colors), options = {
                        element: ele[0],
                        data: data,
                        colors: colors || ["#0B62A4", "#3980B5", "#679DC6", "#95BBD7", "#B0CCE1", "#095791", "#095085", "#083E67", "#052C48", "#042135"]
                    }, attrs.formatter && (func = new Function("y", "data", attrs.formatter), options.formatter = func), chart = new Morris.Donut(options),$(window).resize(function(){
                        chart.redraw();
                    });
            }
        }
    };
}]);
