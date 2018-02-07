<template>
    <section class="home">
        <b-jumbotron header="Vue.JS Wordpress Theme" lead="Bootstrap Vue Included!" class="text-center mb-5 py-5">
        </b-jumbotron>
        <b-container>
            <b-row>
                <b-col>
                    <recent-posts-widget limit="5">Recent Posts</recent-posts-widget>
                </b-col>
                <b-col>
                    <pages-widget limit="5">Pages</pages-widget>
                </b-col>
                <b-col>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </b-col>
            </b-row>
        </b-container>
    </section>
</template>

<script>
    import RecentPostsWidget from '../widgets/RecentPosts'
    import PagesWidget from '../widgets/Pages'

    export default {
        components: {
            RecentPostsWidget,
            PagesWidget
        }
    }
</script>

<style lang="scss">
</style>
