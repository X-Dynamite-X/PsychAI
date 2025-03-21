<div class="fixed inset-0 flex items-center justify-center z-50 hidden bg-opacity-50 backdrop-blur-sm deleteModal" id="deleteModal">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-gray-800 rounded-lg shadow-xl">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold text-white">
                    Delete User Data
                </h3>
                <button type="button" onclick="closeModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-600 hover:text-white rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                    Are you sure you want to delete <span id="deleteUserName"></span>?
                </h3>
                <div class="flex justify-center gap-4">
                    <button type="button" onclick="confirmDelete()"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center">
                        Yes, I'm sure
                    </button>
                    <button type="button" onclick="closeModal()"
                        class="closeDeleteModal text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        No, cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

