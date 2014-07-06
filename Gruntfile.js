'use strict';
module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        // watch our project for changes
        watch: {
            less: {
				files: ['public/assets/less/*','admin/assets/less/*'],
                tasks: ['less']
            },
            livereload: {
                options: { livereload: true },
                files: ['public/assets/**/*', '**/*.html', '**/*.php', 'public/assets/img/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },
        // style (Sass) compilation via Compass
		less: {
			adminLess: {
		    	options: {
		      		paths: ["admin/assets/less"],
		      		cleancss:true
		    	},
		    	files: {
		      		"admin/assets/css/admin.css": "admin/assets/less/admin.less"
		    	}
		  	},
		  	publicLess: {
		    	options: {
		      		paths: ["public/assets/less"],
		      		cleancss:true
		    	},
		    	files: {
		      		"public/assets/css/style.css": "public/assets/less/style.less"
		    	}
		  	}
		},
		        // concatenation and minification all in one
   		uglify: {
            publicscripts: {
                options: {
                    sourceMap: 'public/assets/js/aesop-stories.js.map',
                    sourceMappingURL: 'aesop-stories.js.map',
                    sourceMapPrefix: 10
                },
               	files: {
                    'public/assets/js/aesop-stories.min.js': [
                     	'public/assets/js/public.js'
                    ]
                }
            }
        }
    });

    // register task
    grunt.registerTask('default', ['watch']);

};