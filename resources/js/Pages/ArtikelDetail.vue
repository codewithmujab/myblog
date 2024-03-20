<template>
    <div>
        ArtikelDetail
        <br />
        {{ artikel.slug }}
    </div>
</template>

<script setup>
const props = defineProps({
    artikel: Object,
})
</script>

<style lang="scss" scoped></style>