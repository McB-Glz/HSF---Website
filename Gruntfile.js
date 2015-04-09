module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    less: {
      dist: {
        files: {
          'public/assets/css/main.min.css': [
            'resources/assets/less/app.less'
          ]
        },
        options: {
          compress: false,
          // LESS source map
          // To enable, set sourceMap to true and update sourceMapRootpath based on your install
          sourceMap: true,
          sourceMapFilename: 'main.min.css.map',
          sourceMapRootpath: '/'
        }
      }
    },
    copy: {
      main: {
        files: [
          {
            cwd: 'bower_components/jquery/dist',
            src: ['**'],
            dest: 'public/assets/js',
            expand: true
          },
          {
            cwd: 'bower_components/fontawesome/fonts',
            src: ['**'],
            dest: 'public/assets/fonts/',
            expand: true
          },
          {
            cwd: 'bower_components/bootstrap/fonts',
            src: ['**'],
            dest: 'public/assets/fonts/',
            expand: true
          }
        ],
      },
    },
    uglify: {
      dist: {
        files: {
          'public/assets/js/app.min.js': [
            // 'application/assets/vendor/components/jquery/dist/jquery.js',
            'bower_components/bootstrap/js/affix.js',
            'bower_components/bootstrap/js/alert.js',
            'bower_components/bootstrap/js/button.js',
            'bower_components/bootstrap/js/carousel.js',
            'bower_components/bootstrap/js/collapse.js',
            'bower_components/bootstrap/js/dropdown.js',
            'bower_components/bootstrap/js/modal.js',
            'bower_components/bootstrap/js/tooltip.js',
            'bower_components/bootstrap/js/popover.js',
            'bower_components/bootstrap/js/scrollspy.js',
            'bower_components/bootstrap/js/tab.js',
            'bower_components/bootstrap/js/transition.js',
            'bower_components/WOW/dist/wow.min.js',
            'bower_components/bootstrapvalidator/dist/js/bootstrapValidator.js',
            'resources/assets/js/lib/bootstrapValidator.min.js',
            'resources/assets/js/lib/bootstrapValidatorFormFramework.min.js',
            'resources/assets/js/classie.js',
            'resources/assets/js/global.js',
            'resources/assets/js/jquery.vegas.js',
            'resources/assets/js/jquery.vegas.min.js',
            'resources/assets/js/app.js'
          ],
        },
        options: {
          // JS source map: to enable, uncomment the lines below and update sourceMappingURL based on your install
          sourceMap: 'public/assets/js/scripts.min.js.map'
        }
      }
    },
    watch: {
      less: {
        files: [
          'resources/assets/less/*.less'
        ],
        tasks: ['less']
      },
      js: {
        files: [
          'resources/assets/js/*.js'
        ],
        tasks: ['uglify']
      },
      livereload: {
        // Browser live reloading
        // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
        options: {
          livereload: true
        },
        files: [
          'public/assets/css/main.min.css',
          'views/*.html',
          '*.html'
        ]
      }
    },
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');


  // Default task(s).
  grunt.registerTask('default', ['less', 'copy', 'uglify','watch']);

};
