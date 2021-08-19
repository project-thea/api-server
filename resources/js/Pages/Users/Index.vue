<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <jet-button v-if="$page.props.loggedInUser.can.isAdmin" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-8" @click="createUser()">
                            Add User
                        </jet-button>
                        
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col" width="150" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="user in users.data" :key="user.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ user.first_name }} {{ user.last_name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ user.email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ user.name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <inertia-link @click="editUser(user.id)" :href="'/users/' + user.id + '/edit'" v-if="$page.props.loggedInUser.can.isAdmin" class="mr-2 text-blue-600 hover:text-blue-900">
                                                Edit
                                            </inertia-link>
                                            
                                            <inertia-link @click="deleteUser(user.id)" :href="'/users/' + user.id + '/trash'" v-if="$page.props.loggedInUser.can.isAdmin" class="text-red-600 hover:text-red-900">
                                                Archive
                                            </inertia-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination class="mt-2" :links="users.links" />
                    </div>

                    <!-- User Trash -->
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8" v-if="$page.props.loggedInUser.can.isAdmin">
                        <div class="mb-4 w-full ">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                User Trash
                            </h2>
                        </div>

                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th scope="col" width="100" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr v-for="user in trashedUsers.data" :key="user.id">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ user.first_name }} {{ user.last_name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ user.email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                             {{ user.name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <inertia-link @click="restoreUser(user.id)" :href="'/users/' + user.id + '/restore'" class="text-green-600 hover:text-green-900">
                                                Restore
                                            </inertia-link>
                                        </td>
                                    </tr>
                                    <tr v-if="trashedUsers.data.length === 0">
                                        <td class="border-t px-6 py-4" colspan="4">
                                            No user trash found.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <pagination class="mt-2" :links="trashedUsers.links" />
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Icon from '@/Shared/Icon'
import Pagination from '@/Jetstream/Pagination'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import { Inertia } from '@inertiajs/inertia'

export default {
  	metaInfo: { title: 'Users' },

	components: {
		Icon,
		Pagination,
		AppLayout,
		JetButton,
		JetInput
	},

	props: {
		users: {
			type: Object,
			required: true,
		},
		trashedUsers: {
			type: Object,
			required: true,
		},
        filters: {
			type: Object,
			required: true
		}
	},

	data() {
		return {
			search: 'dd', //this.filters.search
        }
	},

	watch: {
	},

	methods: {
		createUser() {
			Inertia.get('/users/create');
		},
        editUser(id) {
            Inertia.get('/users/' + id + '/edit');
        },
		deleteUser(id) {
			Inertia.delete('/users/' + id + '/trash');
		},
		restoreUser(id) {
            Inertia.put('/users/' + id + '/restore');
		}
	},
}
</script>