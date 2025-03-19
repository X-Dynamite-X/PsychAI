@extends('layouts.admin')

@section('content')
    <div id="loadingIndicator"
        class="hidden fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg py-8 ">
        <div>

            <label for="table-search" class="sr-only">Search</label>
            <div class="relative  ">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="searchInput"
                    class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-[70vw] my-4 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for users">
            </div>

        </div>


        <table class="  w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody id="usersTableBody">
                @include('partials.users.users-table', ['users' => $users])
            </tbody>
        </table>
    </div>
    <div id="pagination">@include('partials.users.pagination', ['users' => $users])</div>
@endsection("content")

@section('models')
    @include('model.users.edit')
    @include('model.users.delete')
@endsection("model")
@section('loding')
    <!-- Loading Indicator -->
    <div id="loadingIndicator"
        class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center">
        <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-white"></div>
    </div>
@endsection("loding")
