module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		concat: {
			options: {
				separator: "\n/* ------------------- */\n"
			},
			js: {
				src: ["bower_components/jquery/dist/jquery.min.js",
					  "bower_components/angular/angular.min.js",
					  "bower_components/angular-route/angular-route.min.js",
					  "bower_components/bootstrap/dist/js/bootstrap.min.js",
					  "app/frontend/js/main.js",
					  "app/frontend/js/controllers/*.js"
					  ],
				dest: "public/js/compiled.js"
			},
			css: {
				src: ["bower_components/bootstrap/dist/css/bootstrap.min.css",
					  "public/css/stylus.css"
					 ],
				dest: "public/css/compiled.css"
			}
		},
		stylus: {
			compile : {
				options: {
					import: ["nib"],
					compress: false
				},
				files: {
					"public/css/stylus.css" : ["app/frontend/stylus/*.styl"]
				}
			}
		},
		copy: {
			main: {
				src: "app/frontend/views/*.html",
				dest: "public/views/",
				flatten: true,
				expand: true
			}
		},
		watch: {
			stylesheets: {
				files: "app/frontend/**/*.styl",
				tasks: ["stylus", "concat"]
			},
			scripts: {
				files: "app/frontend/**/*.js",
				tasks: ["concat"]
			},
			views: {
				files: "app/frontend/views/*.html",
				tasks: ["copy"]
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-stylus');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-copy');

	grunt.registerTask("default", ["stylus", "concat", "copy"]);
}
