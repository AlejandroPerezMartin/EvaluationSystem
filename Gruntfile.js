module.exports = function(grunt) {

    // Project configuration.
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

        /*------------------------------*\
           CSSMin
        \*------------------------------*/
        cssmin: {
            combine: {
                files: {
                    'css/build/styles.min.css': ['css/styles.tidy.css']
                }
            }
        },

        /*------------------------------*\
           UnCSS
        \*------------------------------*/
        uncss: {
            dist: {
                options: {
                    ignore: ['.class-to-ignore']
                },
                files: {
                    'css/styles.tidy.css': ['*.html']
                }
            }
        },

        /*------------------------------*\
           Uglify
        \*------------------------------*/
        uglify: {
            options: {
                beautify: false,
                compress: {
                    drop_console: true
                },
                preserveComments: false
            },
            build: {
                src: 'js/build/scripts.production.js',
                dest: 'js/build/scripts.min.js'
            }
        },


        /*------------------------------*\
           LESS
        \*------------------------------*/
        less: {
            compile: {
                options: {
                    compress: false,
                    cleancss: false,
                    optimization: 2
                },
                files: {
                    "css/styles.css": "css/less/main.less"
                }
            }
        },


        /*------------------------------*\
           JSHint
        \*------------------------------*/
        jshint: {
            options: {
                reporter: require('jshint-stylish')
            },
            development: 'js/**/*.js',
            beforeconcat: ['js/libs/*.js', 'js/*.js'],
            afterconcat: 'js/build/scripts.production.js'
        },


        /*------------------------------*\
           Concat
        \*------------------------------*/
        concat: {
            dist: {
                src: ['js/libs/*.js', 'js/*.js'],
                dest: 'js/build/scripts.production.js',
            },
        },


        /*------------------------------*\
           CSSLint
        \*------------------------------*/
        csslint: {
            strict: {
                options: {
                    import: 2
                },
                src: 'css/build/styles.min.css'
            },
            lax: {
                options: {
                    import: false
                },
                src: 'css/build/styles.min.css'
            }
        },


        /*------------------------------*\
           Watch
        \*------------------------------*/
        watch: {
            src: {
                files: ['js/*.js', 'js/libs/*.js', 'css/less/*.less'],
                tasks: ['dev'],
                options: {
                    livereload: true,
                    spawn: false
                }
            }
        }

    });

    // Load the plugins that provide the tasks
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-csslint');
    grunt.loadNpmTasks('grunt-contrib-htmlmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-uncss');

    // Default task
    grunt.registerTask('default', ['watch']);

    // Development task
    grunt.registerTask('dev', ['jshint:development', 'less', 'csslint']);

    // Build project
    grunt.registerTask('build', ['jshint:beforeconcat', 'concat', 'jshint:afterconcat', 'uglify', 'less', 'uncss', 'cssmin', 'csslint', 'htmlmin']);

};
