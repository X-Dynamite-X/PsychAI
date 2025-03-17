<tr data-user-id="{{ $user->id }}">
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
        {{ $user->id }}
    </td>e
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300 user-name">
        {{ $user->name }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300 user-email">
        {{ $user->email }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap user-status">

            <span class="px-3 py-1 inline-flex items-center justify-center text-xs leading-5 font-semibold rounded-full bg-green-100 bg-opacity-20 text-green-400 border border-green-400 border-opacity-20">
                <i class="fas fa-check-circle mr-1"></i>
                {{ $user->roles->first()->name }}
            </span>

    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
        {{ $user->created_at->format('Y-m-d H:i') }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <button onclick='openEditModal(@json($user))' class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
            Edit
        </button>
        <button onclick="openDeleteModal({{ $user->id }})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
            Delete
        </button>
    </td>
</tr>
