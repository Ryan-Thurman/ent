// See http://brunch.io for documentation.
exports.config = {

    files: {
        javascripts: {
          joinTo: {
              'javascripts/app.js' : /^(src|node_modules)/,
          }
      },
      stylesheets: {
          joinTo: {
              'stylesheets/app.css' : /^(src|node_modules)/,
          }
      }
    },
    paths: {
        public: '/',
        watched: [ 'src' ]
    },
    plugins: {
        stylus: {
            includeCss: true
        }
    },
    modules: {
        nameCleaner: path => path.replace(/^src\//, '')
    },
    npm: {
        enabled: true,
        globals: {
            $: 'jquery/dist/jquery.js',
            jQuery: 'jquery/dist/jquery.js',
            bootstrap: 'bootstrap/dist/js/bootstrap'
        }
    },
    server: {
        run: true
    }
}
