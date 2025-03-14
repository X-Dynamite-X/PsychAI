  <div class="fixed inset-0 flex items-center justify-center z-50   bg-opacity-50 hidden editModal" id="editModal-{{$user->id}}">
      <div class="relative p-4 w-full max-w-md">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
              <!-- Modal header -->
              <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                      Edit user data
                  </h3>
                  <button type="button" id="closeEditModal"
                      class="closeEditModal end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                      </svg>
                      <span class="sr-only">Close modal</span>
                  </button>
              </div>
              <!-- Modal body -->
               <div class="p-4 md:p-5">
                  <form id="userEditForm" data-id="{{$user->id}}" data-user="{{$user}}" class="space-y-4" >
                    @csrf
                    @method("put")
                    <div class="mt-4">
                          <label for="name"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Name</label>
                          <input type="text" name="name" id="name" placeholder="{{ $user->name }}"
                              value="{{ $user->name }}"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                              required />
                      </div>
                      <div class="mt-4">
                          <label for="email"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                          <input type="email" name="email" id="email"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                              placeholder="{{ $user->email }}" value="{{ $user->email }}" required />
                      </div>

                      <button type="submit"
                          class="w-full mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                          Save Changes
                      </button>
                  </form>
              </div>
          </div>
      </div>
  </div>
