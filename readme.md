![Vue + Wordpress.](http://res.cloudinary.com/evanagee/image/upload/v1507763167/VueWP/vue-wordpress-sitting-in-a-tree.jpg)

# vuejs-wordpress-theme-starter
A true WordPress theme with the guts ripped out and replaced with Vue. Based on [EvanAgee's billiant work](https://github.com/EvanAgee/vuejs-wordpress-theme-starter), which was originally based on the [BlankSlate](https://github.com/tidythemes/blankslate) WP starter theme.

## Features
- [VueRouter](https://github.com/vuejs/vue-router) integrated
- [Vuex](https://github.com/vuejs/vuex) integrated (with sample WordPress-centric modules)
- [Axios](https://github.com/axios/axios) for API requests
- [Bootstrap Vue](https://bootstrap-vue.js.org/) for easy Bootstrap 4 Components
- [Font Awesome 5](https://github.com/FortAwesome/Font-Awesome) for vector & social icons
- Follows the development guidelines/structure set forth by Vuejs
- Bare essentials needed for a functional WordPress theme
- All requests are redirected back to the index.php so your Vue routing is respected.
- SCSS support

## Getting started

- Clone the repo inside of your `wp-content/themes/` directory
- Navigate to the theme directory and run
    `npm install`
    `npm run watch` for development
    `npm run production` when you're ready to deploy the theme.

## Usage

- Open up `src/app.js` this is the main JS file for the app and will give you a glimpse into what's going on behind the scenes.
- Next open up `src/App.vue` this is the primary app component, a page wrapper of sorts. It contains the header/footer and the `<router-view>` component which is what loads in all of the other screens as you navigate around the app. Note that by default `src/components/Home.vue` is loaded into the `router-view` initially.
- Next open up `src/routes/index.js` and notice how the routes are setup by default. Out of the box there is only one route, the `/` or home view. For more information on setting up routing within your app checkout [Vue-Router](https://router.vuejs.org/).

The first thing you're probably going to want to do is start editing and components in `src/components/views/`.

## Code Organization
All of the code you're going to edit is located in `/src/`. From there it's broken into a few logical directories.

- `/src`
  - `/api` for API requests
  - `/assets` for images mostly
  - `/components` Vue components
  - `/router` vue-router directives
  - `/store` vuex store and modules
  - `/styles` SCSS styles
  - `/vendor` 3rd party scripts and libraries

All scripts and styles in `/src` are compiled down to the `/dist` directory, which is what you will deploy. **When you're ready to deploy don't deploy the src/ directory.**

## Routes

By default, this theme sets up three separate routes. One for the homepage, one for WordPress pages and one for WordPress posts. These routes can be found in `/src/router/index.js`

In order to separate pages from posts, you'll need to change the permalinks settings. By default, we've created a `home` page and a `news` page. Next, set these up as the static pages via: 

1. In the admin dashboard
1. Go to `Settings > Reading` option
1. Select `A static page (select below)` option for `Your homepage displays`.
1. Set `Homepage:` as `Home`
1. Set `Posts:` as `News`
1. Press `Saves Changes` button
1. Go to `Settings > Permalinks`
1. Select the permalinks structure as `Custom Structure` with the entry `/news/%postname%/`
1. PRess the `Save Changes` button


## External References
- [Creating Vuex Modules](https://vuex.vuejs.org/en/modules.html)
- [vue-router](https://github.com/vuejs/vue-router)
- [WordPress REST API](http://v2.wp-api.org/)
- [Original Vue.js Wordpress Theme](https://github.com/EvanAgee/vuejs-wordpress-theme-starter)
