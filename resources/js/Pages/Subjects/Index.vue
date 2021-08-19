<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subjects
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					
					<div class="mb-4 w-full ">
						<div class="flex justify-between">
							<jet-input id="filter" type="text" class="block" required autofocus placeholder="Search..." v-on:update:modelValue="handleSearchChange" :modelValue="this.filters.search"/>
							
							<jet-button v-if="$page.props.loggedInUser.can.isAdmin" class="float-left bg-grey-400" @click="createSubject()">
								Add Subject
							</jet-button>
						</div>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">

					  	<table class="w-full whitespace-nowrap">
							<thead>
								<tr class="text-left font-bold">
									<th class="px-6 pt-6 pb-4">
										Name
									</th>
									<th class="px-6 pt-6 pb-4">
										Unique ID
									</th>
									<th class="px-6 pt-6 pb-4">
										Phone Number
									</th>
									<th class="px-6 pt-6 pb-4">
										Registration Date
									</th>
									<th class="px-6 pt-6 pb-4" colspan="3" style="width: 100px">
										Actions
									</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="subject in subjects.data" :key="subject.id"
									class="hover:bg-gray-100 focus-within:bg-gray-100"
								>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center focus:text-indigo-500"
											:href="'/subjects/' + subject.id + '/edit'"
										>
											{{ subject.first_name }} {{ subject.last_name }}
											<icon
											v-if="subject.deleted_at"
											name="trash"
											class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"
											/>
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center focus:text-indigo-500"
											:href="'/subjects/' + subject.id + '/edit'"
										>
											{{ subject.unique_id }}
											<icon
											v-if="subject.deleted_at"
											name="trash"
											class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"
											/>
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center focus:text-indigo-500"
											:href="'/subjects/' + subject.id + '/edit'"
										>
											{{ subject.phone }}
											<icon
											v-if="subject.deleted_at"
											name="trash"
											class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"
											/>
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center"
											:href="'/subjects/' + subject.id + '/edit'"
											tabindex="-1"
											aria-label="Edit"
										>
											{{ formatDate(subject.created_at) }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link @click="deleteSubject(subject.id)"
											class="px-6 py-4 flex items-center"
											:href="'/subjects/' + subject.id + '/trash'"
											tabindex="-1"
											aria-label="Trash"
											title="Trash" v-if="$page.props.loggedInUser.can.isAdmin"
										>
											<icon
											name="trash"
											class="block w-4 h-4 fill-gray-500"
											/>
										</inertia-link>
									</td>

									<td class="border-t">
										<inertia-link @click="createQuestionnaire(subject.id)" :href="'/questionnaires/' + subject.id + '/create'" tabindex="-1" aria-label="Add" title="Add Questionnaire" class="px-6 py-4 flex items-center">
											<icon name="add-test" class="block w-4 h-4 fill-gray-500"/>
										</inertia-link>
									</td>
									<td class="border-t w-px">
										<inertia-link
											class="px-6 py-4 flex items-center"
											:href="'/tracking?uids=' + subject.unique_id"
											tabindex="-1"
											aria-label="Track"
											title="Track"
										>
											<icon
											name="gps-route"
											class="block w-4 h-4 fill-gray-500"
											/>
										</inertia-link>
									</td>
									<td class="border-t w-px">
										<inertia-link
											class="px-4 flex items-center"
											:href="'/subjects/' + subject.id + '/edit'"
											tabindex="-1"
											aria-label="Edit"
										>
											<icon
											name="cheveron-right"
											class="block w-6 h-6 fill-gray-500"
											/>
										</inertia-link>
									</td>
								</tr>
								<tr v-if="subjects.data.length === 0">
									<td
									class="border-t px-6 py-4"
									colspan="4"
									>
									No subject found.
									</td>
								</tr>
							</tbody>
					  </table>
					</div>
					<pagination class="mt-2" :links="subjects.links" />	
                </div>
            </div>
        </div>

		<!-- Subject Trash -->
		<div class="py-12" v-if="$page.props.loggedInUser.can.isAdmin">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
				
					<div class="mb-4 w-full ">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight">
							Subject Trash
						</h2>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">

					  	<table class="w-full whitespace-nowrap">
							<thead>
								<tr class="text-left font-bold">
									<th class="px-6 pt-6 pb-4">
										Name
									</th>
									<th class="px-6 pt-6 pb-4">
										Unique ID
									</th>
									<th class="px-6 pt-6 pb-4">
										Phone Number
									</th>
									<th class="px-6 pt-6 pb-4">
										Registration Date
									</th>
									<th class="px-6 pt-6 pb-4" colspan="3" style="width: 100px">
										Actions
									</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="subject in trashedSubjects.data" :key="subject.id"
									class="hover:bg-gray-100 focus-within:bg-gray-100"
								>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center focus:text-indigo-500"
										>
											{{ subject.first_name }} {{ subject.last_name }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ subject.unique_id }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ subject.phone }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link
											class="px-6 py-4 flex items-center" tabindex="-1" aria-label="Edit">
											{{ formatDate(subject.created_at) }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link @click="restoreSubject(subject.id)"
											:href="'/subjects/' + subject.id + '/restore'"
											class="px-6 py-4 flex items-center"
											tabindex="-1"
											aria-label="Restore"
											title="Restore"
										>
											<icon
											name="restore"
											class="block w-4 h-4 fill-gray-500"
											/>
										</inertia-link>
									</td>
								</tr>
								<tr v-if="trashedSubjects.data.length === 0">
									<td
									class="border-t px-6 py-4"
									colspan="4"
									>
									No subject trash found.
									</td>
								</tr>
							</tbody>
					  </table>
					</div>
					<pagination class="mt-2" :links="trashedSubjects.links" />		
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
import { DateTime } from 'luxon';

export default {
  	metaInfo: { title: 'Subjects' },

	components: {
		Icon,
		Pagination,
		AppLayout,
		JetButton,
		JetInput
	},

	props: {
		subjects: {
			type: Object,
			required: true,
		},
		filters: {
			type: Object,
			required: true
		},
		trashedSubjects: {
			type: Object,
			required: true,
		},
	},

	data() {
		return {
			search: this.filters.search,
		}
	},
	methods: {
		handleSearchChange: function (value) {
			Inertia.get('/subjects?search=' + value)
		},
		formatDate(dateTime) {
			return DateTime.fromISO(dateTime).toFormat('yyyy-LL-dd HH:mm');
		},
		createSubject() {
			Inertia.get('/subjects/create')
		},
		deleteSubject(id) {
			Inertia.delete('/subjects/' + id + '/trash');
		},
		restoreSubject(id) {
			Inertia.put('/subjects/' + id + '/restore');
		}, 
		createQuestionnaire(id) {
			Inertia.get('/questionnaires/' + id + '/create')
		}
	},
}
</script>
