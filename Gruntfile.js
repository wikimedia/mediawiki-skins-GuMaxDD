module.exports = function ( grunt ) {
	grunt.loadNpmTasks( 'grunt-banana-checker' );

	var conf = grunt.file.readJSON( 'skin.json' );
	grunt.initConfig( {
		banana: conf.MessagesDirs
	} );

	grunt.registerTask( 'test', [ 'banana' ] );
	grunt.registerTask( 'default', 'test' );
};
