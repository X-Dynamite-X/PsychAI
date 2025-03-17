<div class="fixed inset-0 flex items-center justify-center z-50 hidden bg-opacity-50 backdrop-blur-sm editModal"
    id="editModal">
    <div class="relative p-4 w-full max-w-md">
        <div class="relative bg-gray-800 rounded-lg shadow-xl">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-700">
                <h3 class="text-xl font-semibold text-white">
                    Edit User Data
                </h3>
                <button type="button" onclick="closeModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-600 hover:text-white rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form id="editForm" class="space-y-4">
                    @csrf
                    @method('put')

                    <!-- Hidden input for user ID -->
                    <input type="hidden" value="" id="editUserId" name="user_id">

                    <div>
                        <label for="editName" class="block mb-2 text-sm font-medium text-gray-300">
                            User Name
                        </label>
                        <input type="text" name="name" id="editName"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                        <span class="text-red-500 text-sm hidden error-message" id="nameError"></span>
                    </div>

                    <div>
                        <label for="editEmail" class="block mb-2 text-sm font-medium text-gray-300">
                            Email
                        </label>
                        <input type="email" name="email" id="editEmail"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            required />
                        <span class="text-red-500 text-sm hidden error-message" id="emailError"></span>
                    </div>

                    <div>
                        <label for="editRole" class="block mb-2 text-sm font-medium text-gray-300">
                            User Role
                        </label>
                        <select name="role" id="editRole"
                            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg

                                   focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="admin">Admin</option>
                            <option value="doctor">Doctor</option>
                            <option value="user">User</option>
                        </select>
                        <span class="text-red-500 text-sm hidden error-message" id="roleError"></span>
                    </div>

                    <!-- Error Container -->
                    <div id="editUserErrors" class="hidden">
                        <ul class="text-red-500 text-sm list-disc list-inside"></ul>
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-800
                               font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-300">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
