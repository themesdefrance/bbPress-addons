module.exports = function(grunt){
	
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		watch: {
			compile: {
				files: ['template/css/scss/*.scss'],
				tasks: ['default']
			}
		},
		compass: {
			options:{
				sassDir: 'template/css/scss/',
				require: []
			},
			build: {
				options:{
					cssDir: 'template/css/',
					outputStyle: 'compressed'
				}
			},
			dev: {
				options:{
					cssDir: 'template/css/scss/',
					outputStyle: 'expanded',
					noLineComments: true
				}
			},
			
		},
		copy: {
			build: {
				expand: true,
				src: ['**', '!.sass-cache', '!bbpress-balzac/', '!node_modules/**', '!Gruntfile.js', '!README.md', '!package.json'],
				dest: 'bbpress-balzac/',
			}
		}
	});
	
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-copy');
	
	grunt.registerTask('default', ['compass:dev','compass:build']);
	grunt.registerTask('build', ['compass:dev','compass:build','copy:build']);

}