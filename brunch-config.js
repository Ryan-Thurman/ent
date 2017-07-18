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
        public: 'dist',
        watched: [ 'src', "templates" ]
    },
    plugins: {
        stylus: {
            includeCss: true
        },
        browserSync: {
          port: 3333,
          proxy: {
              target: "http://idwent.dev/"
          },
          logLevel: "debug"
      }
    },
    modules: {
        nameCleaner: path => path.replace(/^src\//, '')
    },
    npm: {
        enabled: true,
        globals: {
            $: 'jquery/dist/jquery.js',
						jQuery: 'jquery/dist/jquery.js'
        }
    },
    conventions: {
        ignored: [
            /^(.*?\/)?[_]\w*/
        ]
    },
}
