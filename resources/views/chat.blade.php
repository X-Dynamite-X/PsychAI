@extends('layouts.app')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Courier+Prime:ital,wght@1,700&display=swap');
    
    .chat-container {
        background-color: #FCEBDC;
        font-family: 'Courier Prime', monospace;
    }
    
    .message-bubble {
        border: 2px solid #5E875E;
        transition: all 0.3s ease;
    }
    
    .message-bubble:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
<div class="h-[calc(100vh-4rem)] flex flex-col chat-container">
    <!-- Main Chat Container -->
    <div class="flex-1 flex flex-col">
        <!-- Chat Header -->
        <div class="bg-[#FCEBDC] p-4 border-b-2 border-[#5E875E]">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-[#403540]">المساعد النفسي الذكي</h1>
                    <p class="text-sm text-[#5E875E]">متواجد دائماً للمساعدة والدعم</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="p-2 hover:bg-[#5E875E]/10 rounded-full transition-colors" title="مسح المحادثة">
                        <i class="fas fa-trash text-[#5E875E]"></i>
                    </button>
                    <button class="p-2 hover:bg-[#5E875E]/10 rounded-full transition-colors" title="تحميل المحادثة">
                        <i class="fas fa-download text-[#5E875E]"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Chat Messages Area -->
        <div class="flex-1 bg-[#FCEBDC] overflow-y-auto" id="chat-messages">
            <div class="max-w-7xl mx-auto p-4 space-y-6">
                <!-- Welcome Message -->
                <div class="flex justify-center">
                    <div class="message-bubble bg-white rounded-lg p-4 max-w-lg text-center">
                        <img src="{{ asset('logo_1.svg') }}" alt="Logo" class="w-20 h-20 mx-auto mb-4">
                        <h2 class="text-lg font-semibold text-[#403540] mb-2">مرحباً بك في المساعد النفسي الذكي</h2>
                        <p class="text-[#5E875E]">كيف يمكنني مساعدتك اليوم؟</p>
                    </div>
                </div>

                <!-- AI Message Example -->
                <div class="flex items-start space-x-4 space-x-reverse max-w-3xl mx-auto">
                    <div class="w-10 h-10 rounded-full bg-[#5E875E] flex items-center justify-center">
                        <i class="fas fa-robot text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="message-bubble bg-white rounded-lg p-4">
                            <p class="text-[#403540]">مرحباً! أنا هنا للمساعدة. يمكنك أن تسألني عن أي شيء يتعلق بالصحة النفسية.</p>
                        </div>
                        <div class="mt-1 text-xs text-[#5E875E] mr-2">11:30 AM</div>
                    </div>
                </div>

                <!-- User Message Example -->
                <div class="flex items-start flex-row-reverse space-x-4 space-x-reverse max-w-3xl mx-auto">
                    <div class="w-10 h-10 rounded-full bg-[#059669] flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="message-bubble bg-[#059669]/10 rounded-lg p-4">
                            <p class="text-[#403540]">مرحباً، أريد أن أتحدث عن القلق الذي أشعر به</p>
                        </div>
                        <div class="mt-1 text-xs text-[#5E875E] ml-2">11:31 AM</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Input Area -->
        <div class="bg-[#FCEBDC] border-t-2 border-[#5E875E] p-4">
            <div class="max-w-7xl mx-auto">
                <form id="chat-form" class="flex gap-4 items-end">
                    <div class="flex-1">
                        <textarea
                            class="w-full bg-white border-2 border-[#5E875E] rounded-lg focus:ring-2 focus:ring-[#5E875E] focus:border-[#5E875E] text-[#403540] placeholder-[#5E875E]/60 resize-none p-4 h-[60px] max-h-[200px]"
                            rows="1"
                            placeholder="اكتب رسالتك هنا..."
                        ></textarea>
                    </div>
                    <button
                        type="submit"
                        class="bg-[#059669] hover:bg-[#047857] text-white rounded-lg px-6 py-3 flex items-center gap-2 transition-all duration-200 border-2 border-[#5E875E]"
                    >
                        <span>إرسال</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Disclaimer -->
    <div class="bg-[#FCEBDC] border-t-2 border-[#5E875E]">
        <div class="max-w-7xl mx-auto px-4 py-3">
            <p class="text-center text-sm text-[#403540]">
                <i class="fas fa-info-circle ml-2"></i>
                هذا المساعد مخصص للمساعدة العامة فقط وليس بديلاً عن الاستشارة الطبية المتخصصة
            </p>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // سيتم إضافة الوظائف التفاعلية هنا لاحقاً
</script>
@endsection