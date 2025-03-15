@extends('layouts.app')
@section("styles")
<style>
    main {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 40px;
        padding: 40px;
        background-color: #FCEBDC;
        min-height: calc(100vh - 4rem);
        direction: rtl;
    }

    .past-conversations {
        /* background-color: rgba(255, 255, 255, 0.7); */
        padding: 25px;
        border-radius: 15px;
        height: fit-content;
        border: 2px solid #5E875E;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .past-conversations h3 {
        color: #403540;
        font-size: 20px;
        margin-bottom: 20px;
        text-align: center;
        font-weight: bold;
        border-bottom: 2px solid #5E875E;
        padding-bottom: 10px;
    }

    .conversations-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .past-conversations li {
        list-style: none;
        background-color: #5E875E;
        color: white;
        padding: 15px 20px;
        border-radius: 10px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .past-conversations li:before {
        content: '💬';
        font-size: 18px;
    }

    .past-conversations li:hover {
        background-color: #4a6b4a;
        transform: translateX(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .chat-area {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
       
    }

    .chat-area h2 {
        color: #403540;
        font-size: 28px;
        margin-bottom: 30px;
        font-family: 'Courier Prime', monospace;
        font-weight: bold;
    }

    .message-input-container {
        width: 100%;
        max-width: 800px;
        display: flex;
        gap: 15px;
        margin-bottom: 35px;
    }

    .chat-area textarea {
        flex: 1;
        height: 60px;
        padding: 15px 20px;
        border: 2px solid #5E875E;
        border-radius: 15px;
        resize: none;
        font-size: 16px;
        background-color: #FCEBDC;
        transition: all 0.3s ease;
    }

    .chat-area textarea:focus {
        outline: none;
        border-color: #403540;
        box-shadow: 0 0 0 3px rgba(94, 135, 94, 0.2);
        height: 100px;
    }

    .chat-area textarea::placeholder {
        color: #666;
    }

    .send-button {
        background-color: #5E875E;
        color: white;
        border: none;
        padding: 0 25px;
        border-radius: 15px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .send-button:hover {
        background-color: #4a6b4a;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .chat-area .options {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
        max-width: 800px;
    }

    .chat-area .options button {
        background-color: #FCEBDC;
        border: 2px solid #5E875E;
        padding: 12px 25px;
        border-radius: 25px;
        cursor: pointer;
        color: #403540;
        font-size: 15px;
        transition: all 0.3s ease;
        min-width: 130px;
    }

    .chat-area .options button:hover {
        background-color: #5E875E;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 968px) {
        main {
            grid-template-columns: 1fr;
            gap: 30px;
            padding: 20px;
        }

        .chat-area {
            padding: 20px;
        }

        .message-input-container {
            flex-direction: column;
        }

        .send-button {
            padding: 15px;
        }

        .chat-area .options button {
            min-width: calc(50% - 10px);
        }
    }
</style>
@endsection

@section('content')
    <main>
        <div class="chat-area">
            <h2>بماذا تود التحدث؟</h2>
            <div class="message-input-container">
                <textarea placeholder="أنا أعاني من.."></textarea>
                <button class="send-button">
                    <i class="fas fa-paper-plane"></i>
                    <span>إرسال</span>
                </button>
            </div>
            <div class="options">
                <button>القلق</button>
                <button>الاكتئاب</button>
                <button>الاحتراق النفسي</button>
                <button>متلازمة المحتال</button>
                <button>المزيد</button>
            </div>
        </div>

        <div class="past-conversations">
            <h3>المحادثات السابقة</h3>
            <div class="conversations-list">
                <li>محادثة جديدة</li>
                <li>القلق والتوتر</li>
                <li>الاكتئاب</li>
            </div>
        </div>
    </main>
@endsection
