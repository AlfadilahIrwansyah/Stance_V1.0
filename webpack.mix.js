const mix = require('laravel-mix');

// Example of copying Bootstrap Icons from node_modules to the public directory
mix.copy('node_modules/bootstrap-icons/icons', 'public/icons/bootstrap-icons');

// Other configurations
mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .version();  // Enables versioning (cache busting)
