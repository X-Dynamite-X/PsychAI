<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Function to toggle dark mode
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <!-- Navbar -->
    <div class="bg-white dark:bg-gray-800 shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold dark:text-white">Admin Panel</h1>
            <div class="flex items-center">
                <span class="text-gray-700 dark:text-gray-300 mr-4">Welcome, Admin</span>
                <button onclick="toggleDarkMode()" class="p-2 bg-gray-200 dark:bg-gray-700 rounded-full">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="bg-gray-800 dark:bg-gray-900 text-white w-64 min-h-screen py-6">
            <div class="px-4">
                <h2 class="text-lg font-semibold">Menu</h2>
                <ul class="mt-4">
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700 dark:hover:bg-gray-700 rounded">Users</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700 dark:hover:bg-gray-700 rounded">Settings</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700 dark:hover:bg-gray-700 rounded">Reports</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700 dark:hover:bg-gray-700 rounded">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content -->
        <div class="flex-1 p-8">
            <h2 class="text-2xl font-semibold mb-4 dark:text-white">Users</h2>
            <!-- Table -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Last Active</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 dark:text-white">1</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">John Doe</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">john.doe@example.com</div>
                            </td>
                            <td class="px-6 py-4 dark:text-white">Admin</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 rounded-full">Active</span>
                            </td>
                            <td class="px-6 py-4 dark:text-white">2 hours ago</td>
                            <td class="px-6 py-4">
                                <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Delete</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 dark:text-white">2</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Jane Smith</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">jane.smith@example.com</div>
                            </td>
                            <td class="px-6 py-4 dark:text-white">Editor</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 rounded-full">Active</span>
                            </td>
                            <td class="px-6 py-4 dark:text-white">5 minutes ago</td>
                            <td class="px-6 py-4">
                                <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Delete</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 dark:text-white">3</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Robert Johnson</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">robert.johnson@example.com</div>
                            </td>
                            <td class="px-6 py-4 dark:text-white">User</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-sm font-semibold bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900 rounded-full">Inactive</span>
                            </td>
                            <td class="px-6 py-4 dark:text-white">2 days ago</td>
                            <td class="px-6 py-4">
                                <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Delete</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 dark:text-white">4</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Emily Davis</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">emily.davis@example.com</div>
                            </td>
                            <td class="px-6 py-4 dark:text-white">User</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 rounded-full">Active</span>
                            </td>
                            <td class="px-6 py-4 dark:text-white">1 hour ago</td>
                            <td class="px-6 py-4">
                                <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Delete</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 dark:text-white">5</td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Michael Wilson</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">michael.wilson@example.com</div>
                            </td>
                            <td class="px-6 py-4 dark:text-white">Editor</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-sm font-semibold bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 rounded-full">Active</span>
                            </td>
                            <td class="px-6 py-4 dark:text-white">Just now</td>
                            <td class="px-6 py-4">
                                <button class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">Edit</button>
                                <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
                <nav class="inline-flex rounded-md shadow">
                    <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-l-md">Previous</a>
                    <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">1</a>
                    <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">2</a>
                    <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">3</a>
                    <a href="#" class="px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-r-md">Next</a>
                </nav>
            </div>
        </div>
    </div>
</body>
</html>
