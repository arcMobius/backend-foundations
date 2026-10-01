<template>
    <div v-if="article != null" style="background-color: #cce5ff; color: #004085; padding: 15px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #b8daff;" role="alert">
        Добавлена новая статья: <strong><a :href="`/articles/${article.id}`">{{ article.name }}</a></strong>
    </div>
</template>

<script>
    export default {
        data() { 
            return { article: null } 
        },
        created() {
            window.Echo.channel('test').listen('NewArticleEvent', (e) => {
                this.article = e.article;
            })
        }
    }
</script>
