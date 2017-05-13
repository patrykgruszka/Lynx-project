'use strict';
module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        manifest: grunt.file.readJSON('manifest.json'),
        jshint: {
            scripts: [
                '<%= manifest.path.source %>/scripts/**/*.js'
            ]
        },
        concat: {
            options: {
                separator: ';',
                sourceMap: true
            },
            scripts: {
                src: [
                    'node_modules/jquery/dist/jquery.slim.js',
                    '<%= manifest.path.source %>/vendor/jquery-ui.min.js',
                    'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
                    'node_modules/angular/angular.js',
                    '<%= manifest.path.source %>/scripts/app.js',
                    'src/Lynx/TaskboardBundle/Resources/scripts/**/*.js',
                    '<%= manifest.path.source %>/scripts/main.js'
                ],
                dest: '<%= manifest.path.dist %>/scripts/bundle.js',
                options: {
                    sourceMapStyle: 'inline'
                }
            }
        },
        sass: {
            styles: {
                options: {
                    sourceMap: true,
                    sourceMapEmbed: true
                },
                files: {
                    '<%= manifest.path.dist %>/styles/bundle.css': '<%= manifest.path.source %>/styles/main.scss'
                }
            }
        },
        cssmin: {
            styles: {
                files: {
                    '<%= manifest.path.dist %>/styles/bundle.min.css': '<%= manifest.path.dist %>/styles/bundle.css'
                }
            }
        },
        uglify: {
            scripts: {
                files: {
                    '<%= manifest.path.dist %>/scripts/bundle.min.js': '<%= manifest.path.dist %>/scripts/bundle.js'
                }
            }
        },
        watch: {
            options: {
                livereload: true
            },
            styles: {
                files: [
                    '<%= manifest.path.source %>/styles/**/*.scss'
                ],
                tasks: ['sass']
            },
            scripts: {
                files: [
                    '<%= manifest.path.source %>/scripts/**/*.js'
                ],
                tasks: ['jshint', 'concat:scripts']
            }
        },
        clean: {
            cache: ['app/cache'],
            styles: ['<%= manifest.path.dist %>/styles'],
            scripts: ['<%= manifest.path.dist %>/scripts']
        }
    });

    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-clean');

    grunt.registerTask('default', ['clean', 'jshint', 'concat', 'sass', 'uglify', 'cssmin']);
};