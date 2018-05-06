const createExternalsConfig = function () {
    const entryPointNames = [
        'blocks',
        'components',
        'date',
        'editor',
        'element',
        'utils',
        'data',
        'viewport',
        'core-data',
        'plugins',
        'edit-post',
        'core-blocks',
    ];

    const externals = {
        react: 'React',
        'react-dom': 'ReactDOM',
        tinymce: 'tinymce',
        moment: 'moment',
        jquery: 'jQuery',
        lodash: 'lodash',
        'lodash-es': 'lodash',
    };

    [
        ...entryPointNames,
    ].forEach((name) => {
        externals[`@wordpress/${ name }`] = {
            this: ['wp', camelCaseDash(name)],
        };
    });
    return externals;
};

module.exports = {
    createConfig: createExternalsConfig(),
};