<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="pt-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    
		<!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
          <div class="dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-600 dark:border-gray-600 font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
              <svg width="56px" height="56px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<title>ic_fluent_patient_24_filled</title>
				<desc>Created with Sketch.</desc>
				<g id="🔍-Product-Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<g id="ic_fluent_patient_24_filled" fill="#212121" fill-rule="nonzero">
						<path d="M17.75,2 C18.9926407,2 20,3.00735931 20,4.25 L20,19.754591 C20,20.9972317 18.9926407,22.004591 17.75,22.004591 L6.25,22.004591 C5.00735931,22.004591 4,20.9972317 4,19.754591 L4,4.25 C4,3.05913601 4.92516159,2.08435508 6.09595119,2.00519081 L6.25,2 L17.75,2 Z M18.5,16 L5.5,16 L5.5,19.754591 C5.5,20.1688046 5.83578644,20.504591 6.25,20.504591 L17.75,20.504591 C18.1642136,20.504591 18.5,20.1688046 18.5,19.754591 L18.5,16 Z M7.75128856,17.5 L16.25,17.5 C16.6642136,17.5 17,17.8357864 17,18.25 C17,18.6296958 16.7178461,18.943491 16.3517706,18.9931534 L16.25,19 L7.75128856,19 C7.337075,19 7.00128856,18.6642136 7.00128856,18.25 C7.00128856,17.8703042 7.28344245,17.556509 7.64951801,17.5068466 L7.75128856,17.5 L16.25,17.5 L7.75128856,17.5 Z M17.75,3.5 L6.25,3.5 L6.14822944,3.50684662 C5.78215388,3.55650904 5.5,3.87030423 5.5,4.25 L5.5,14.5 L8,14.5 L8,12.2455246 C8,11.5983159 8.49187466,11.0659907 9.12219476,11.0019782 L9.25,10.9955246 L14.75,10.9955246 C15.3972087,10.9955246 15.9295339,11.4873992 15.9935464,12.1177193 L16,12.2455246 L16,14.5 L18.5,14.5 L18.5,4.25 C18.5,3.83578644 18.1642136,3.5 17.75,3.5 Z M12,4.99552458 C13.3807119,4.99552458 14.5,6.11481271 14.5,7.49552458 C14.5,8.87623646 13.3807119,9.99552458 12,9.99552458 C10.6192881,9.99552458 9.5,8.87623646 9.5,7.49552458 C9.5,6.11481271 10.6192881,4.99552458 12,4.99552458 Z" id="🎨-Color"></path>
					</g>
				</g>
			</svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">{{ num_subjects }}</p>
              <p>Subjects</p>
            </div>
          </div>
          <div class="dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-600 dark:border-gray-600 font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 489.988 489.988" style="enable-background:new 0 0 489.988 489.988;" xml:space="preserve" stroke="currentColor" class="stroke-current text-gray-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out"><g>	<path d="M452.625,271.274l-226.8-226.9l8.8-8.8c8.3-8.3,8.3-20.8,0-29.1s-20.8-8.3-29.1,0l-199.3,199.4c-8.3,8.3-8.3,20.8,0,29.1		c11.4,11.4,24.5,4.9,29.1,0l9.3-9.3l226.4,226.2c77.7,70.1,156.7,26.1,181.7,1C502.325,402.874,502.525,321.074,452.625,271.274z		 M197.225,72.974l212.9,213.8h-248.2l-89.3-89.3L197.225,72.974z M423.625,423.874c-16.6,16.6-76.8,47.7-124.6,0l-95.5-95.5		c0,0,237-0.2,238.7-0.7C455.925,359.574,449.725,397.774,423.625,423.874z"/></g></svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">{{ num_tests }}</p>
              <p>Tests</p>
            </div>
          </div>
          <div class="dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-600 dark:border-gray-600 font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
			<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
				 viewBox="0 0 297.002 297.002" style="enable-background:new 0 0 297.002 297.002;" xml:space="preserve">
			<g>
				<g>
					<g>
						<path d="M272.237,123.737c-10.349,0-19.231,6.384-22.927,15.418h-38.585c-1.563-10.519-5.72-20.202-11.802-28.374l21.369-21.369
							c2.797,1.108,5.764,1.666,8.733,1.666c6.049,0,12.1-2.303,16.705-6.908c9.211-9.211,9.211-24.199,0-33.41
							c-9.211-9.21-24.199-9.21-33.41,0h-0.001c-6.865,6.865-8.61,16.937-5.242,25.437l-21.389,21.389
							c-8.143-6.026-17.773-10.147-28.232-11.701V48.079c9.035-3.696,15.418-12.577,15.418-22.926
							c0-13.655-11.108-24.763-24.763-24.763c-13.655,0-24.763,11.108-24.763,24.763c0,10.349,6.384,19.231,15.418,22.926v37.807
							c-10.393,1.544-19.965,5.626-28.075,11.589L89.413,76.198c3.368-8.5,1.623-18.572-5.242-25.437
							c-9.211-9.211-24.199-9.211-33.41,0s-9.211,24.199,0,33.41c4.606,4.606,10.656,6.908,16.705,6.908
							c2.968,0,5.934-0.558,8.732-1.666l21.213,21.213c-6.145,8.204-10.341,17.945-11.914,28.53H47.69
							c-3.696-9.035-12.577-15.418-22.927-15.418C11.108,123.737,0,134.845,0,148.5c0,13.655,11.108,24.763,24.763,24.763
							c10.349,0,19.231-6.384,22.927-15.418h37.807c1.554,10.459,5.676,20.09,11.701,28.233l-21,21
							c-8.5-3.368-18.572-1.623-25.437,5.242c-9.211,9.211-9.211,24.199,0,33.41c4.606,4.606,10.656,6.908,16.705,6.908
							s12.1-2.302,16.705-6.908c6.865-6.865,8.61-16.937,5.242-25.437l20.98-20.98c8.172,6.082,17.855,10.239,28.373,11.802v37.807
							c-9.035,3.696-15.418,12.577-15.418,22.926c0,13.655,11.108,24.763,24.763,24.763c13.655,0,24.763-11.108,24.763-24.763
							c0-10.349-6.384-19.231-15.418-22.926v-37.807c10.585-1.573,20.325-5.77,28.53-11.914l21.602,21.602
							c-3.368,8.5-1.623,18.572,5.242,25.437c4.606,4.606,10.656,6.908,16.705,6.908c6.049,0,12.1-2.302,16.705-6.908
							c9.211-9.211,9.211-24.199,0-33.409c-4.461-4.463-10.394-6.921-16.705-6.921c-3.043,0-5.995,0.577-8.74,1.669l-21.658-21.658
							c5.964-8.11,10.045-17.683,11.59-28.075h38.585c3.696,9.035,12.577,15.418,22.927,15.418c13.655,0,24.763-11.108,24.763-24.763
							C297.002,134.846,285.892,123.737,272.237,123.737z M225.534,63.976c1.925-1.924,5.056-1.924,6.98,0
							c0.933,0.932,1.445,2.171,1.445,3.49c0,1.319-0.513,2.558-1.445,3.49c-1.924,1.925-5.056,1.924-6.98,0
							C223.61,69.031,223.61,65.899,225.534,63.976z M70.956,70.955c-1.924,1.925-5.056,1.925-6.98,0c-1.925-1.924-1.925-5.056,0-6.979
							c0.962-0.963,2.226-1.444,3.49-1.444s2.528,0.481,3.49,1.444C72.881,65.901,72.881,69.032,70.956,70.955z M24.763,154.574
							c-3.349,0-6.074-2.725-6.074-6.074s2.725-6.074,6.074-6.074s6.074,2.725,6.074,6.074S28.112,154.574,24.763,154.574z
							 M70.955,232.514c-1.924,1.925-5.056,1.925-6.979,0c-1.925-1.924-1.925-5.056,0-6.979c0.962-0.963,2.226-1.444,3.49-1.444
							s2.528,0.481,3.49,1.444C72.88,227.459,72.88,230.59,70.955,232.514z M148.111,19.078c3.349,0,6.074,2.725,6.074,6.074
							s-2.725,6.074-6.074,6.074s-6.074-2.725-6.074-6.074S144.762,19.078,148.111,19.078z M148.111,277.922
							c-3.349,0-6.074-2.725-6.074-6.074s2.725-6.074,6.074-6.074s6.074,2.725,6.074,6.074S151.46,277.922,148.111,277.922z
							 M148.111,193.12c-24.603,0-44.62-20.017-44.62-44.62c0-24.603,20.016-44.62,44.62-44.62c24.603,0,44.62,20.017,44.62,44.62
							C192.731,173.103,172.714,193.12,148.111,193.12z M226.045,226.044c0.932-0.933,2.171-1.445,3.49-1.445
							c1.317,0,2.556,0.513,3.489,1.446c1.925,1.924,1.925,5.056,0,6.979c-1.924,1.925-5.056,1.925-6.979,0
							C224.12,231.099,224.12,227.969,226.045,226.044z M272.237,154.574c-3.349,0-6.074-2.725-6.074-6.074s2.725-6.074,6.074-6.074
							s6.074,2.725,6.074,6.074S275.586,154.574,272.237,154.574z"/>
						<path d="M145.725,143.836c6.557-6.558,6.557-17.229-0.001-23.787c-6.558-6.556-17.229-6.556-23.787,0v0.001
							c-6.559,6.558-6.559,17.229-0.001,23.787c3.178,3.176,7.402,4.926,11.895,4.926C138.323,148.763,142.548,147.014,145.725,143.836
							z M128.224,131.943c0-1.497,0.584-2.906,1.642-3.965c2.186-2.186,5.745-2.185,7.929,0c2.186,2.186,2.186,5.744,0.001,7.93
							c-1.059,1.059-2.468,1.642-3.965,1.642c-1.497,0-2.906-0.583-3.965-1.642C128.807,134.849,128.224,133.44,128.224,131.943z"/>
						<path d="M132.012,156.23c-6.559,6.558-6.559,17.229,0,23.787c3.279,3.28,7.586,4.919,11.893,4.919s8.614-1.639,11.893-4.919
							c6.559-6.558,6.559-17.229,0-23.787C149.241,149.672,138.57,149.672,132.012,156.23z M147.871,172.089
							c-2.186,2.185-5.744,2.185-7.93,0c-2.186-2.186-2.186-5.744,0-7.93c1.093-1.092,2.53-1.639,3.965-1.639s2.872,0.547,3.965,1.639
							C150.056,166.345,150.056,169.902,147.871,172.089z"/>
					</g>
				</g>
			</g>
			</svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">{{ num_diseases }}</p>
              <p>Diseases</p>
            </div>
          </div>
          <div class="dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-gray-600 dark:border-gray-600 font-medium group">
            <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 459.864 459.864" style="enable-background:new 0 0 459.864 459.864;" xml:space="preserve" class="stroke-current text-blue-800 dark:text-gray-800">
				<g>
					<g>
						<g>
							<path d="M395.988,193.978c-6.215,8.338-13.329,15.721-21.13,21.941c33.044,21.079,55.005,58.06,55.005,100.077
								c0,13.638-20.011,23.042-31.938,27.434c-9.301,3.425-20.237,6.229-32.19,8.347c0.387,5.05,0.586,10.153,0.586,15.3
								c0,4.455-0.389,9.647-1.518,15.299c16.064-2.497,30.815-6.128,43.488-10.794c42.626-15.694,51.573-38.891,51.573-55.586
								C459.863,265.52,434.565,220.85,395.988,193.978z"/>
							<path d="M311.244,15.147c-18.734,0-36.411,7.436-50.724,21.145c5.632,7.212,10.553,15.004,14.733,23.246
								c9.592-10.94,22.195-17.602,35.991-17.602c29.955,0,54.325,31.352,54.325,69.888s-24.37,69.888-54.325,69.888
								c-9.01,0-17.507-2.853-24.995-7.868c-2.432,8.863-5.627,17.42-9.53,25.565c10.642,5.952,22.36,9.093,34.525,9.093
								c45.83,0,81.115-44.3,81.115-96.678C392.359,59.441,357.069,15.147,311.244,15.147z"/>
							<path d="M259.999,226.28c-6.487,8.205-13.385,15.089-20.57,20.892c40.84,24.367,68.257,68.991,68.257,119.904
								c0,17.196-24.104,28.639-38.472,33.929c-26.025,9.583-62.857,15.078-101.053,15.078c-38.196,0-75.029-5.495-101.054-15.078
								c-14.368-5.29-38.472-16.732-38.472-33.929c0-50.914,27.417-95.538,68.257-119.904c-7.184-5.802-14.083-12.687-20.57-20.892
								C30.403,256.335,0,308.218,0,367.077c0,18.127,9.926,43.389,57.213,60.8c29.496,10.861,68.898,16.841,110.947,16.841
								c42.049,0,81.451-5.98,110.947-16.841c47.287-17.411,57.213-42.673,57.213-60.8C336.32,308.218,305.918,256.335,259.999,226.28z"
								/>
							<path d="M168.16,242.764c53.003,0,93.806-51.234,93.806-111.804c0-60.571-40.808-111.804-93.806-111.804
								c-52.995,0-93.806,51.223-93.806,111.804C74.354,191.542,115.169,242.764,168.16,242.764z M168.16,47.79
								c35.936,0,65.171,37.31,65.171,83.169s-29.236,83.169-65.171,83.169s-65.171-37.31-65.171-83.169S132.225,47.79,168.16,47.79z"/>
						</g>
					</g>
				</g>
				</svg>
            </div>
            <div class="text-right">
              <p class="text-2xl">{{ num_users }}</p>
              <p>Users</p>
            </div>
          </div>
        </div>
        <!-- ./Statistics Cards -->
		
                </div>
            </div>
        </div>
		
		<!-- Chart -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

					<div class="p-4">
						<bar-chart v-bind:chartdata="chartData"/>
					</div>
                </div>
            </div>
        </div>
		<!-- ./Chart -->
		
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
	import BarChart from '@/Jetstream/BarChart'

    export default {
		data () {
		  return {
			chartData: {}
		  }
		},
        components: {
            AppLayout,
			BarChart
        },
		props: {
			num_subjects: Number,
			num_tests: Number,
			num_diseases: Number,
			num_users: Number,
			data: Array
	   },
	   created() {
			this.chartData = {
				'subjects': this.data.map(v => v.num_subjects),
				'tests' : this.data.map(v => v.num_tests),
				'diseases' : this.data.map(v => v.num_diseases),
				'dates': this.data.map(v => v.the_date)
			};
	  },
    }
</script>

<style>
  .small {
    max-width: 600px;
    margin:  150px auto;
  }
</style>