@extends('layouts.app')

@section('content')
<div class="h-[calc(100vh-4rem)] flex flex-col">
    <!-- Main Chat Container -->
    <div class="flex-1 flex flex-col">
        <!-- Chat Header -->
        <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">المساعد النفسي الذكي</h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">متواجد دائماً للمساعدة والدعم</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full" title="مسح المحادثة">
                        <i class="fas fa-trash text-gray-500 dark:text-gray-400"></i>
                    </button>
                    <button class="p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full" title="تحميل المحادثة">
                        <i class="fas fa-download text-gray-500 dark:text-gray-400"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Chat Messages Area -->
        <div class="flex-1 bg-gray-50 dark:bg-gray-900 overflow-y-auto" id="chat-messages">
            <div class="max-w-7xl mx-auto p-4 space-y-6">
                <!-- Welcome Message -->
                <div class="flex justify-center">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 max-w-lg text-center">
                        <i class="fas fa-robot text-3xl text-blue-500 mb-2"></i>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">مرحباً بك في المساعد النفسي الذكي</h2>
                        <p class="text-gray-600 dark:text-gray-400">كيف يمكنني مساعدتك اليوم؟</p>
                    </div>
                </div>

                <!-- AI Message Example -->
                <div class="flex items-start space-x-4 space-x-reverse max-w-3xl mx-auto">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center shadow-md">
                        <i class="fas fa-robot text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                            <p class="text-gray-800 dark:text-white">مرحباً! أنا هنا للمساعدة. يمكنك أن تسألني عن أي شيء يتعلق بالصحة النفسية.</p>
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400 mr-2">11:30 AM</div>
                    </div>
                </div>

                <!-- User Message Example -->
                <div class="flex items-start flex-row-reverse space-x-4 space-x-reverse max-w-3xl mx-auto">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-emerald-500 to-emerald-600 flex items-center justify-center shadow-md">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="bg-emerald-50 dark:bg-gray-700 rounded-lg shadow-sm p-4">
                            <p class="text-gray-800 dark:text-white">مرحباً، أريد أن أتحدث عن القلق الذي أشعر به</p>
                        </div>
                        <div class="mt-1 text-xs text-gray-500 dark:text-gray-400 ml-2">11:31 AM</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Input Area -->
        <div class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 p-4">
            <div class="max-w-7xl mx-auto">
                <form id="chat-form" class="flex gap-4 items-end">
                    <div class="flex-1 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <textarea
                            class="w-full bg-transparent border-0 focus:ring-0 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 resize-none p-4 h-[60px] max-h-[200px]"
                            rows="1"
                            placeholder="اكتب رسالتك هنا..."
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg px-6 py-3 flex items-center gap-2 shadow-lg hover:shadow-xl transition-all duration-200"
                    >
                        <span>إرسال</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Disclaimer -->
    <div class="bg-yellow-50 dark:bg-gray-800 border-t border-yellow-100 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <p class="text-center text-sm text-yellow-700 dark:text-yellow-500">
                <i class="fas fa-info-circle ml-2"></i>
                هذا المساعد مخصص للمساعدة العامة فقط وليس بديلاً عن الاستشارة الطبية المتخصصة
            </p>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection

