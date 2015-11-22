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
    mix.styles([
        'bootstrap.min.css',
        'navigationbar.css'
    ]);
    mix.scripts([
        //"jquery-1.11.3.min.js", Not sure if I will need jquery later currently not needed
        //"bootstrap.min.js",
        "script.js"
    ]);
    //mix.scripts([
        //"jquery-1.11.3.min.js",
        //"bootstrap.min.js"
    //], 'public/js/status.js');

});