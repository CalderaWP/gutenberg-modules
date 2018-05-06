
let wpExternals = [];
// Define WordPress dependencies
const wpDependencies = [
    'components',
    'element',
    'blocks',
    'utils',
    'date'
];
// Setup externals for all WordPress dependencies
wpDependencies.forEach( wpDependency => {
    wpExternals[ '@wordpress/' + wpDependency ] = {
        this: [ 'wp', wpDependency ]
    };
});

module.exports = {
    wpDependencies: wpDependencies,
    wpExternals: wpExternals,
};