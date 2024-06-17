const config = {
    mode: 'production',
    entry: {
        index: './src/js/index.js',
        contacts: './src/js/contacts.js',
        services: './src/js/services.js',
        requirements: './src/js/requirements.js',
        delivery: './src/js/delivery.js',
        user: './src/js/user.js',
        cart: './src/js/cart.js',
        constructor: './src/js/constructor.js',
        req: './src/js/req.js',
        admin: './src/js/admin.js',
        admin_service_index: './src/js/admin_service_index.js'
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