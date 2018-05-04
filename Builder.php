<?php

/**
 * @return string
 */
function getGutenbergTag()
{
	exec('cd gutenberg && git describe --tags --abbrev=0', $output );
	$tag = is_array( $output ) ? $output[0] : null;
	exec( 'cd ../' );
	return $tag;
}


/** Clone and build if needed */
if (! file_exists( dirname(__FILE__) . '/gutenberg' )) {
	exec('git clone git@github.com:WordPress/gutenberg.git');
	exec( 'cd gutenberg && npm install && npm run build' );
	exec( 'cd ../' );
}


/** Copy files */
$file = dirname(__FILE__) . '/gutenberg/data/index.js';
$newfile = dirname(__FILE__) . '/dist/data/index.js';

$sourcePath = dirname(__FILE__) . '/gutenberg';
$distPath = dirname(__FILE__) . '/dist';
$modules = [
	'data' => [
		'index.js',
	],
	'components' => [
		'index.js',
		'style.css',
		'style-rtl.css'
	]
];

foreach ($modules as $module => $moduleFiles ){
	foreach ( $moduleFiles as $file ){
		$sourceFile = sprintf('%s/%s/build/%s',
			$sourcePath,
			$module,
			$file
		);


		$distFile = sprintf('%s/%s/%s',
			$distPath,
			$module,
			$file
		);


		if (!copy($sourceFile, $distFile )) {
			throw new Exception( sprintf('Could not copy %s to %s', $sourceFile, $distFile ) );
		}
	}
}

//Tag and push//
$tag = getGutenbergTag();
exec( "git fetch --tags && git tag -d $tag" );
exec( "git add . && git commit -m \"$tag\" && git tag $tag && git push && git push --tags");

