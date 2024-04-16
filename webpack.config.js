const config = {
    mode: 'production',
    entry: {
        index: './src/js/index.js',
        contacts: './src/js/contacts.js',
        services: './src/js/services.js',
        requirements: './src/js/requirements.js',
        delivery: './src/js/delivery.js',
        user: './src/js/user.js',
        cart: './src/js/cart.js'
    },
    output: {
        filename: '[name].bundle.js'
    },
    module: {
        rules: [
            {
                test: /\.css$/,
                use: ['style-loader', 'css-loader']
            },
        ],
    },
};

module.exports = config;