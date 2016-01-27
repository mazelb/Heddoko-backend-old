/*jslint node: true */
"use strict";

/**
 * Copyright Heddoko(TM) 2015, all rights reserved
 */

module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        // bower: {
        //     install: {
        //         options: {
        //             install: true,
        //             copy: false,
        //             targetDir: './libs',
        //             cleanTargetDir: true
        //         }
        //     }
        // },

        clean: {
            temp: {
                src: [ 'tmp' ]
            },
            dist: {
                src: ['public/fonts', 'public/images']
            }
        },

        copy: {
            dist: {
                files: [
                    // Bootstrap fonts.
                    {
                        expand: true,
                        dot: true,
                        cwd: 'bower_components/bootstrap/dist',
                        src: ['fonts/*.*'],
                        dest: 'public'
                    },

                    // Font-Awesome.
                    {
                        expand: true,
                        dot: true,
                        cwd: 'bower_components/fontawesome',
                        src: ['fonts/*.*'],
                        dest: 'public'
                    },

                    // App fonts.
                    {
                        expand: true,
                        dot: true,
                        cwd: 'resources/assets',
                        src: ['fonts/*.*'],
                        dest: 'public'
                    },

                    // App images.
                    {
                        expand: true,
                        dot: true,
                        cwd: 'resources/assets/images',
                        src: ['*.*','**/*.*'],
                        dest: 'public/images'
                    }
                ]
            }
        },

        jshint: {
            dist: [
                'Gruntfile.js',
                'resources/assets/js/*.js',
                'resources/assets/js/**/*.js'
            ]
        },

        uglify: {
            options: {
                mangle: {
                    except: ['jQuery', '$']
                }
            },
            dist: {
                files: {
                    'resources/assets/build/scripts.js': [
                        'resources/assets/js/**/*.js',
                        'resources/assets/js/*.js'
                    ]
                }
            }
        },

        html2js: {
            options: {
                base: 'resources/angular-views',
                module: 'app.views'
            },
            dist: {
                src: [
                    'resources/angular-views/*.html',
                    'resources/angular-views/**/*.html'
                ],
                dest: 'resources/assets/build/views.js'
            }
        },

        concat: {
            options: {
                separator: ';\n',
                stripBanners: true,
                banner: '/*! Copyright Heddoko(TM) 2015, all rights reserved. */\n\n'
            },
            dist: {
                src: [

                    // Main dependencides.
                    'bower_components/jquery/dist/jquery.min.js',
                    'bower_components/bootstrap/dist/js/bootstrap.min.js',
                    'bower_components/angular/angular.min.js',
                    'bower_components/underscore/underscore-min.js',

                    // AngularJS
                    'bower_components/ngstorage/ngStorage.min.js',
                    'bower_components/angular-truncate/src/truncate.js',
                    'bower_components/angular-route/angular-route.min.js',
                    'bower_components/angular-animate/angular-animate.min.js',
                    'bower_components/angular-sanitize/angular-sanitize.min.js',
                    'bower_components/ng-file-upload/ng-file-upload-shim.min.js',
                    'bower_components/ng-file-upload/ng-file-upload.min.js',
                    // 'bower_components/textAngular/dist/textAngular.min.js',

                    // Bootstrap 3 Datepicker.
                    'bower_components/moment/min/moment.min.js',
                    'bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',

                    // Chart.js: creates charts. (http://www.chartjs.org/)
                    'bower_components/chartjs/Chart.min.js',

                    // Easypie
                    'bower_components/easypie/dist/angular.easypiechart.min.js',

                    // Flot: creates charts. (http://www.flotcharts.org/)
                    'bower_components/flot/jquery.flot.js',
                    'bower_components/flot/jquery.flot.canvas.js',
                    'bower_components/flot/jquery.flot.categories.js',
                    'bower_components/flot/jquery.flot.crosshair.js',
                    'bower_components/flot/jquery.flot.image.js',
                    'bower_components/flot/jquery.flot.navigate.js',
                    'bower_components/flot/jquery.flot.time.js',
                    'bower_components/flot/jquery.flot.pie.js',
                    'bower_components/flot/jquery.flot.resize.js',
                    'bower_components/flot/jquery.flot.selection.js',
                    'bower_components/flot/jquery.flot.stack.js',

                    // Intro.js: for onboarding.
                    'bower_components/intro.js/minified/intro.min.js',

                    // morris.js: creates charts.
                    'bower_components/raphael/raphael-min.js',
                    'bower_components/morrisjs/morris.min.js',

                    // Selectize: select boxes with AJAX options.
                    'bower_components/selectize/dist/js/standalone/selectize.min.js',
                    'bower_components/angular-selectize2/dist/angular-selectize.js',

                    // TODO: determine which of these dependencies are still needed.
                    'bower_components/slimScroll/jquery.slimscroll.min.js',
                    'angular-app/scripts/gmap.js',
                    // 'bower_components/jquery.sparkline.build/dist/jquery.sparkline.min.js',
                    // 'bower_components/angular-wizard/dist/angular-wizard.js',
                    'bower_components/rangy/rangy-core.min.js',
                    'bower_components/rangy/rangy-selectionsaverestore.min.js',
                    'bower_components/angular-ui-tree/dist/angular-ui-tree.js',
                    'bower_components/jqvmap/jqvmap/jquery.vmap.min.js',
                    'bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js',
                    'angular-app/scripts/other_charts.js',
                    'angular-app/scripts/extras.js',
                    // 'bower_components/chartist/dist/chartist.js',
                    // 'bower_components/angular-chartist.js/dist/angular-chartist.min.js',

                    // Pre-compiled Angular views.
                    'resources/assets/build/views.js',

                    // Application scripts.
                    'resources/assets/build/scripts.js'
                ],

                dest: 'public/js/scripts.js'
            }
        },

		sass: {
            dist: {
                files: {
                    'resources/assets/build/styles.css': 'resources/assets/sass/main.scss'
                }
            }
        },

        cssmin: {
            combine: {
                files: {
                    'public/css/styles.css': [

                        // Bootstrap
                        'bower_components/bootstrap/dist/css/bootstrap.min.css',
                        'bower_components/bootstrap/dist/css/bootstrap-theme.min.css',

                        // Font-Awesome icons
                        'bower_components/fontawesome/css/font-awesome.min.css',

                        // AngularJS
                        // 'bower_components/textAngular/dist/textAngular.css',

                        // Charts
                        'bower_components/chartist/dist/chartist.min.css',

                        // Intro.js: for onboarding
                        'bower_components/intro.js/minified/introjs.min.css',

                        // Bootstrap 3 Datepicker
                        'bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',

                        // Selectize
                        'bower_components/selectize/dist/css/selectize.bootstrap3.css',

                        // Application styles
                        'resources/assets/build/styles.css'
                    ]
                }
            },
            add_banner: {
                options: {
                    banner: '/* Copyright Heddoko(TM) 2015, all rights reserved */'
                },
                files: {
                    'public/css/styles.css': ['public/css/styles.css']
                }
            }
        },

        // assets_versioning: {
        //     options: {
        //         versionsMapFile: 'resources/assets/rev.json'
        //     },
        //     js: {
        //         files: {
        //             'public/js/scripts.js': ['public/js/scripts.js']
        //         }
        //     },
        //     css: {
        //         files: {
        //             'public/css/styles.css': ['public/css/styles.css']
        //         }
        //     }
        // },

        watch: {
            dist: {
                files: [
                    'Gruntfile.js',
                    'resources/angular-views/*.html',
                    'resources/angular-views/**/*.html',
                    'resources/assets/images/*.*',
                    'resources/assets/images/**/*.*',
                    'resources/assets/js/*.js',
                    'resources/assets/js/**/*.js',
                    'resources/assets/sass/*.scss',
                    'resources/assets/sass/**/*.scss'
                ],
                tasks: [
                    // 'clean:temp',
                    'jshint:dist',
                    'uglify:dist',
                    'html2js:dist',
                    'concat:dist',
                    'sass',
                    'cssmin',
                    'clean:dist',
                    'copy:dist'
                ],
                options: {
                    atBegin: true
                }
            }
            // dev: {
            //     files: [
            //         'Gruntfile.js',
            //         'resources/assets/js/*.js',
            //         'resources/assets/js/**/*.js',
            //         'angular-app/styles/*.scss'
            //     ],
            //     // tasks: [ 'jshint', 'html2js:dist', 'copy:main', 'concat:dist', 'clean:temp', 'sass', 'cssmin' ],
            //     tasks: [
            //         'jshint',
            //         'concat:dist',
            //         'sass',
            //         'cssmin'
            //     ],
            //     options: {
            //         atBegin: true
            //     }
            // },
            // min: {
            //     files: [
            //         'Gruntfile.js',
            //         'resources/assets/js/*.js',
            //         'resources/assets/js/**/*.js',
            //         'angular-app/styles/*.scss'
            //     ],
            //     tasks: [
            //         'jshint',
            //         'html2js:dist',
            //         'copy:main',
            //         'concat:dist',
            //         'clean:temp',
            //         'uglify:dist',
            //         'cssmin'
            //     ],
            //     options: {
            //         atBegin: true
            //     }
            // }
        },

        compress: {
            dist: {
                options: {
                    archive: 'dist/<%= pkg.name %>-<%= pkg.version %>.zip'
                },
                files: [{
                    src: [ 'index.html' ],
                    dest: '/'
                }, {
                    src: [ 'app/**' ],
                    dest: 'app/'
                }, {
                    src: [ 'app/**' ],
                    dest: 'app/'
                }, {
                    src: [ 'app/**' ],
                    dest: 'app/'
                }]
            }
        }
    });

    // grunt.loadNpmTasks('grunt-assets-versioning');
    grunt.loadNpmTasks('grunt-bower-task');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-html2js');

    // grunt.registerTask('dev', [ 'bower', 'watch:dev' ]);
    // grunt.registerTask('production', [ 'bower', 'watch:min' ]);

    grunt.registerTask('css', ['sass', 'cssmin']);
    grunt.registerTask('js', ['jshint', 'uglify', 'html2js', 'concat']);
    grunt.registerTask('default', ['js', 'css', 'clean:dist', 'copy:dist']);
};
