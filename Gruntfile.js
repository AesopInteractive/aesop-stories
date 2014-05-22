'use strict';
module.exports = function(grunt) {

    require('load-grunt-tasks')(grunt);

    grunt.initConfig({

        // watch our project for changes
        watch: {
            less: {
				files: ['public/assets/less/*'],
                tasks: ['less']
            },
            livereload: {
                options: { livereload: true },
                files: ['public/assets/**/*', '**/*.html', '**/*.php', 'public/assets/img/**/*.{png,jpg,jpeg,gif,webp,svg}']
            }
        },
        // style (Sass) compilation via Compass
		less: {
		  	publicLess: {
		    	options: {
		      		paths: ["public/assets/less"],
		      		cleancss:true
		    	},
		    	files: {
		      		"public/assets/css/style.css": "public/assets/less/style.less"
		    	}
		  	}
		}
    });

    // register task
    grunt.registerTask('default', ['watch']);

};