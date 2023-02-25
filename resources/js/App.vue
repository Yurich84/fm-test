<template>
    <button
        class="main-btn"
        @click="showPopupInvite = true"
    >
        Invite Now
    </button>

    <el-dialog
        v-model="showPopupInvite"
        title="Invite others"
        width="598"
        style="--el-dialog-bg-color: #FDF1E4;"
    >
        <invite-form
            @close="showPopupInvite = false"
        />
    </el-dialog>
</template>

<script setup>
import {ref} from 'vue'
import InviteForm from './components/InviteForm.vue'

const showPopupInvite = ref(false)
</script>
