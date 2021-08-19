<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<jet-section-title>
						<template #title>
							<strong>Add User</strong>
						</template>
					</jet-section-title>
                    
					<form @submit.prevent="createUser">
						<div class="mt-3">
							<jet-label for="first_name" value="First Name" />
							<jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
						</div>

                        <div class="mt-3">
							<jet-label for="last_name" value="Last Name" />
							<jet-input id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="last_name" />
						</div>

                        <div class="mt-3">
                            <jet-label for="email" value="Email" />
                            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="email" />
                        </div>
						
						<div class="mt-4">
                            <jet-label for="password" value="Password" />
                            <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="password" />
                        </div>

                        <div class="mt-4">
                            <jet-label for="role_id" value="Role" />
							<select name="role_id" v-model="form.role_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
                            </select>
                        </div>

						<div class="flex items-center justify-end mt-4">
                            <inertia-link :href="route('users.index')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Back
                            </inertia-link>
							<jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Add User
							</jet-button>
						</div>
					</form>
                </div>
            </div>
        </div>
    </app-layout>  
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Icon from '@/Shared/Icon'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetFormSection from '@/Jetstream/FormSection'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetTextarea from '@/Jetstream/Textarea'
import JetSectionTitle from '@/Jetstream/SectionTitle'

export default {
	metaInfo: { title: 'Users' },
	components: {
		Icon,
		AppLayout,
		JetButton,
		JetInput,
		JetInputError,
		JetLabel,
		JetFormSection,
		JetTextarea,
		JetSectionTitle
	},

	props: {
        roles: {
			type: Array
		},
    },

	data() {
		return {
			form: this.$inertia.form({
				first_name:  '',
				last_name:  '',
				email:  '',
                password: '',
                role_id: '',
			}),
		}
	},

	watch: {
	},

	methods: {
		createUser() {
			this.form.post('/users', {
				errorBag: 'createUser',
				preserveScroll: true,
				onSuccess: () => this.form.reset(),
				onError: () => {
					if (this.form.errors.first_name) {
						this.form.reset('first_name')
						this.$refs.first_name.focus()
					}

                    if (this.form.errors.last_name) {
						this.form.reset('last_name')
						this.$refs.last_name.focus()
					}

                    if (this.form.errors.email) {
						this.form.reset('email')
						this.$refs.email.focus()
					}

                    if (this.form.errors.password) {
						this.form.reset('password')
						this.$refs.password.focus()
					}

                    if (this.form.errors.role_id) {
						this.form.reset('role_id')
						this.$refs.role_id.focus()
					}
				}
			});
		}
	},
}
</script>