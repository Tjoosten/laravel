var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 | Commands:
 |
 | gulp         = Execute all registered tasks at once.
 | gulp watch   = Watch assets for changes.
 | gulp scripts = Only compile scripts.
 | gulp styles  = Only compile styles.
 | gulp tdd     = Watch Tests and PHP classes for changes.
 */

// PHPunit tests.
elixir(function(mix) {
  mix.phpUnit();
});

// Less tasks.
elixir(function(mix) {
  mix.less([
    'bootstrap.less',
  ]);
});
