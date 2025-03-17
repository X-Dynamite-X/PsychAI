@forelse($users as $user)
    <tr class="hover:bg-white hover:bg-opacity-5 transition-colors duration-200" data-user-id="{{ $user->id }}">
        <td class="px-6 py-4 whitespace-nowrap   user-id">{{ $user->id }}</td>
        <td class="px-6 py-4 whitespace-nowrap   user-name">{{ $user->name }}</td>
        <td class="px-6 py-4 whitespace-nowrap   user-email">{{ $user->email }}</td>
        <td class="px-6 py-4 whitespace-nowrap user-status"id="userRole">

            <span
                class="px-3 py-1 user-role inline-flex items-center justify-center text-xs leading-5 font-semibold rounded-full bg-green-100 bg-opacity-20 text-green-400 border border-green-400 border-opacity-20 ">
                <i class="fas fa-check-circle mr-1"></i>
                {{ $user->roles->first()->name }}
            </span>

        </td>
        <td class="px-6 py-4 whitespace-nowrap  ">
            <div class="flex space-x-2">
                <button  onclick="openEditModal({{ json_encode($user) }})"
                    class="p-2 rounded-lg bg-blue-500 text-white  font-bold hover:bg-blue-600   transition duration-200 transform hover:scale-105">
                    Edit
                </button>
                <button onclick="openDeleteModal({{ $user->id }})"
                    class="p-2 rounded-lg bg-red-500 text-white font-bold hover:bg-red-600   transition duration-200 transform hover:scale-105">
                  Delete
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-6 py-4 text-center  ">
            <div class="flex flex-col items-center justify-center space-y-2">
                <i class="fas fa-search text-4xl   text-opacity-40"></i>
                <p class="  text-opacity-60">No users found</p>
            </div>
        </td>
    </tr>
@endforelse
