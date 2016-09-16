var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */


elixir(function(mix) {

   // Sass
   var options = {
       includePaths: [
           'node_modules/foundation-sites/scss',
           'node_modules/motion-ui/src'
       ]
   };

   mix.sass(['app.scss','custom.scss'], null, options);

   // Javascript
   var jQuery = '../../../node_modules/jquery/dist/jquery.js';
   var foundationJsFolder = '../../../node_modules/foundation-sites/js/';

   mix.scripts([
      jQuery,
      '../../../node_modules/foundation-sites/dist/foundation.min.js',
      // This file initializes foundation
      'start_foundation.js'
   ]);

    mix.version(['public/css/app.css','public/js/all.js']);

});
