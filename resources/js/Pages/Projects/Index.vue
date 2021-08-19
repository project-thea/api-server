<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Projects
            </h2>
        </template>

        <div class="py-12">	
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<div class="mb-4 w-full ">
						<div class="flex justify-between">
							<jet-input id="filter" type="text" class="block" required autofocus placeholder="Search..." v-on:update:modelValue="handleSearchChange" :modelValue="this.filters.search"/>
							
							<jet-button v-if="$page.props.loggedInUser.can.isAdmin" class="float-left bg-grey-400" @click="createProject()">
								Add Project
							</jet-button>
						</div>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">
						<table class="w-full whitespace-nowrap">
							<thead>
								<tr class="text-left font-bold">
									<th class="px-6 pt-6 pb-4">Name</th>
									<th class="px-6 pt-6 pb-4">Description</th>
									<th class="px-6 pt-6 pb-4" colspan="2">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="project in projects.data" :key="project.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
									<td class="border-t">
										<inertia-link :href="'/projects/' + project.id + '/edit'" class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ project.name }}
											<icon v-if="project.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"/>	
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link :href="'/projects/' + project.id + '/edit'" tabindex="-1" aria-label="Edit"
											class="px-6 py-4 flex items-center truncate">
											{{ project.description }}
										</inertia-link>
									</td>
									<td class="border-t" v-if="$page.props.loggedInUser.can.isAdmin">
										<inertia-link @click="deleteProject(project.id)" :href="'/projects/' + project.id + '/trash'" method="delete" tabindex="-1" aria-label="Trash"
											title="Trash" class="px-6 py-4 flex items-center">
											<icon name="trash" class="block w-4 h-4 fill-gray-500"/>	
										</inertia-link>
									</td>
									<td class="border-t w-px">
										<inertia-link :href="'/projects/' + project.id + '/edit'" title="Edit" tabindex="-1"
											aria-label="Edit" class="px-4 flex items-center"> 
											<icon name="cheveron-right" class="block w-6 h-6 fill-gray-500"/>
										</inertia-link>
									</td>
								</tr>
								<tr v-if="projects.data.length === 0">
									<td class="border-t px-6 py-4" colspan="4">
										No project found.
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pagination class="mt-2" :links="projects.links" />
                </div>
            </div>
        </div>

		<!-- Trashed Projects -->
		<div class="py-12" v-if="$page.props.loggedInUser.can.isAdmin">	
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<div class="mb-4 w-full ">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight">
							Project Trash
						</h2>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">
						<table class="w-full whitespace-nowrap">
							<thead>
								<tr class="text-left font-bold">
									<th class="px-6 pt-6 pb-4">Name</th>
									<th class="px-6 pt-6 pb-4">Description</th>
									<th class="px-6 pt-6 pb-4" colspan="2">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="project in trashedProjects.data" :key="project.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
									<td class="border-t">
										<inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ project.name }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link tabindex="-1" aria-label="Edit"
											class="px-6 py-4 flex items-center truncate">
											{{ project.description }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link @click="restoreProject(project.id)" :href="'/projects/' + project.id + '/restore'" method="restore" tabindex="-1" aria-label="Restore"
											title="Restore" class="px-6 py-4 flex items-center">
											<icon name="restore" class="block w-4 h-4 fill-gray-500"/>	
										</inertia-link>
									</td>
								</tr>
								<tr v-if="trashedProjects.data.length === 0">
									<td class="border-t px-6 py-4" colspan="4">
										No project trash found.
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pagination class="mt-2" :links="trashedProjects.links" />
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
import JetNavLink from '@/Jetstream/NavLink';

export default {
	metaInfo: { title: 'Projects' },

	components: {
		Icon,
		Pagination,
		AppLayout,
		JetButton,
		JetInput,
		JetNavLink
	},

	props: {
		projects: {
			type: Object,
			required: true,
		},
		filters: {
			type: Object,
			required: true
		},
		trashedProjects: {
			type: Object,
			required: true
		}
	},

	data() {
		return {
			search: this.filters.search
		}
	},

	watch: {
	},
	
	methods: {
		handleSearchChange: function (value) {
			Inertia.get('/projects?search=' + value)
		},
		createProject() {
			Inertia.get('/projects/create')
		},
		trackProject(id) {
			Inertia.delete('/projects/' + id)
		},
		deleteProject(id) {
			Inertia.delete('/projects/' + id + '/trash');
		},
		restoreProject(id) {
			Inertia.put('/projects/' + id + '/restore');
		}
	},
}
</script>
