<template>
    <el-form
        ref="formRef"
        v-loading="loadingRoles"
        :model="form"
        @submit.prevent="onSubmit"
    >
        <el-row>
            <el-col :span="18">
                <el-form-item
                    prop="email"
                    class="form-group"
                    :rules="email_rules"
                >
                    <el-input
                        v-model="form.email"
                        name="email"
                        placeholder="Enter profile E-mails"
                        type="email"
                        @keydown.enter="addEmail"
                    />
                </el-form-item>
            </el-col>
            <el-col :span="6">
                <el-form-item class="form-group">
                    <el-button
                        type="primary"
                        @click="addEmail"
                    >
                        Add
                    </el-button>
                </el-form-item>
            </el-col>
        </el-row>

        <mail-services />

        <div class="recipients">
            <el-form-item
                v-for="(recipient, i) in form.recipients"
                :key="recipient.email"
                :prop="'recipients.' + i + '.role'"
                class="form-group"
                required
            >
                <el-row class="recipient w-100">
                    <el-col :span="12">
                        <div class="recipient__data">
                            <div class="recipient__name">
                                {{ recipient.name }}
                            </div>
                            <div class="recipient__email">
                                {{ recipient.email }}
                            </div>
                        </div>
                    </el-col>
                    <el-col :span="8">
                        <el-select
                            v-model="recipient.role"
                            class="recipient__role"
                        >
                            <el-option
                                v-for="role in roles"
                                :key="role.value"
                                :label="role.value"
                                :value="role.value"
                                style="height: 70px;"
                            >
                                <div style="font-size: 13px;">
                                    {{ role.value }}
                                </div>
                                <div style="font-size: 10px;">
                                    {{ role.text }}
                                </div>
                            </el-option>
                        </el-select>
                    </el-col>
                    <el-col :span="4">
                        <el-icon @click="removeRecipient(i)">
                            <RemoveFilled />
                        </el-icon>
                    </el-col>
                </el-row>
            </el-form-item>
        </div>
        <el-form-item
            prop="Message"
            class="form-group"
        >
            <el-input
                v-model="form.message"
                name="Message"
                placeholder="Personal message (optional)"
            />
        </el-form-item>

        <span>{{ form.recipients.length }} recipients</span>

        <el-form-item>
            <el-button
                type="success"
                :loading="loading"
                @click.prevent="onSubmit"
            >
                Send
            </el-button>
        </el-form-item>
    </el-form>
</template>

<script setup>
import {ref} from 'vue'
import api from '../api'
import {ElMessage} from 'element-plus'
import {faker} from '@faker-js/faker'
import MailServices from './MailServices.vue'

const emit = defineEmits()

const loading = ref(false)
const loadingRoles = ref(false)
const formRef = ref()
const form = ref({recipients: []})
const email = ref('')
const roles = ref([])

const email_rules = [
    {
        required: true,
        message: 'Please input email address',
        trigger: 'change',
    },
    {
        type: 'email',
        message: 'Please input correct email address',
        trigger: 'change',
    },
]

getRoles()

async function getRoles() {
    loadingRoles.value = true
    const {data} = await api.getRoles()
    roles.value = data
    loadingRoles.value = false
}

function addEmail() {
    formRef.value.validate((valid, fields) => {
        if (!fields?.email) {
            form.value.recipients.push({
                email: form.value.email,
                name: faker.name.findName(),
                role: null,
            })
            form.value.email = ''
        }
    })
}

function removeRecipient (i) {
    form.value.recipients.splice(i, 1)
}

function onSubmit(e) {
    formRef.value.validate((valid, fields) => {
        delete fields.email
        if (Object.keys(fields).length === 0) {
            loading.value = true

            api.send(form.value).then(response => {
                ElMessage.success('Emails sent')
                emit('close')
            }).finally(() => loading.value = false)
        }
    })
}

</script>

<style lang="scss">
.recipients {

    max-height: 300px;
    overflow: hidden;
    margin: 15px 0;
    .recipient {
        background: #F6EFE6;
    }
}
</style>
