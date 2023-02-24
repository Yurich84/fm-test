<template>
    <div
        id="mail-services"
        class="mod-block"
    >
        <span>or add from</span>
        <img
            v-for="service in SERVICES"
            :key="service"
            :src="`/icons/${service}.svg`"
            class="handler"
            :alt="service"
        />
    </div>
</template>

<script setup>
const SERVICES = [
    'yahoo',
    'gmail',
    'aol',
    'cloud',
]
</script>
