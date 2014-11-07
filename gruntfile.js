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
	});
	
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-compass');
	
	grunt.registerTask('default', ['compass:dev']);
	grunt.registerTask('build', ['compass:dev','compass:build']);

}