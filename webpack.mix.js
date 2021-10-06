const mix = require('laravel-mix');

mix.js('app/app.js', 'web/app.js')
    .setPublicPath('web')
    .vue();
