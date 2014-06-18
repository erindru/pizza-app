module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		concat: {
			options: {
				separator: "\n/* ------------------- */\n"
			},
			dist: {
				src: ["bower_components/jquery/dist/jquery.min.js",
					  "bower_components/angular/angular.min.js",
					  "bower_components/bootstrap/dist/js/bootstrap.min.js",
					  "app/frontend/js/main.js",
					  "app/frontend/js/controllers/*.js"
					  ],
				dest: "public/js/compiled.js"
			}
		},
		stylus: {
			compile : {
				options: {
					import: ["nib"],
					compress: false
				},
				files: {
					"public/css/compiled.css" : ["app/frontend/stylus/*.styl"]
				}
			}
		},
		watch: {
			stylesheets: {
				files: "app/frontend/**/*.styl",
				tasks: ["stylus"]
			},
			scripts: {
				files: "app/frontend/**/*.js",
				tasks: ["concat"]
			}
		}
	});

	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-stylus');
	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.registerTask("default", ["concat", "stylus"]);
}