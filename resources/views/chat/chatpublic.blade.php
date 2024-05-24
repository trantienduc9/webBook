@extends('admin.default')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .container {
            display: flex;
            /* max-width: 900px; */
            margin: 20px auto;
        }

        .sidebar {
            flex: 1;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            /* Thiết lập chiều cao cố định cho sidebar và thanh cuộn scroll */
            max-height: 400px;
            overflow-y: auto;
        }

        .sidebar-title {
            margin-bottom: 10px;
        }

        .account-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .account {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .chat-container {
            flex: 2;
            margin-left: 20px;
        }

        .chat {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .chat-messages {
            flex: 1;
            overflow-y: scroll;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .message {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .avatar img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .message-content {
            flex: 1;
        }

        .sender {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .text {
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 15px;
            word-wrap: break-word;
        }

        .input-container {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .message-input {
            flex: 1;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }

        .send-button {
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        .send-button:hover {
            background-color: #0056b3;
        }

        /* Thêm CSS mới */
        .dot {
            width: 10px;
            height: 10px;
            background-color: green;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .account-info {
            display: flex;
            align-items: center;
        }

        .avatar,
        .dot,
        .account-name {
            margin-right: 10px;
        }

        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 100%;
            object-fit: cover;
        }

        .status {
            visibility: visible;
        }

        .mymessage {
            background: #6ad9fd;
        }
        #notification{
            margin-left: 76px;
            margin-top: 11px;
        }
    </style>
    <div class="container">
        <div class="sidebar">
            <h2 class="sidebar-title">Accounts</h2>
            <ul class="account-list">
                @foreach ($list_user as $item)
                    <li class="account">
                        <div class="account-info">
                            <a href="{{ route('chatPrivate', $item->id)}}" id="link{{ $item->id }}">
                                <img class="avatar" src="{{ asset($item->URL) }}" alt="lỗi">
                                <span class="account-name">{{ $item->name }}</span>
                            </a>
                        </div>
                    </li>
                @endforeach

                <!-- Additional accounts go here -->
            </ul>
        </div>

        <div class="chat-container">
            <div class="chat">
                <div class="chat-messages sidebar">

                    <!-- Additional messages go here -->
                </div>
                <div class="input-container">
                    <input type="text" class="message-input" id="message" placeholder="Type your message...">
                    <button class="send-button" id="sent" onclick="sendchat()">Send</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script type="module">
        Echo.channel("notification")
            .listen("UserSessionChange", e => {
                console.log(e.user);
                const notiElement = document.querySelector("#notification")
                notiElement.innerText = e.user
                notiElement.classList.remove("invisible")
                notiElement.classList.remove("alert-success")
                notiElement.classList.remove("alert-danger")
                notiElement.classList.add('alert-' + e.type)

            })
        Echo.join('chat')
            .here(users => {
                users.forEach(function(e) {
                    let element = document.getElementById(`link${e.id}`);
                    if (element) {
                        let active = document.createElement('div');
                        active.className = 'dot status';
                        element.appendChild(active);
                    }
                });
            })
            .joining(user => {
                let element = document.getElementById(`link${user.id}`);
                if (element) {
                    let active = document.createElement('div');
                    active.className = 'dot status';
                    element.appendChild(active);
                }
            })
            .leaving(user => {
                let element = document.getElementById(`link${user.id}`);
                let status = element.querySelector('.status');
                if (status) {
                    element.removeChild(status);
                }
            })
            .listen('UserOnline', e => {
                let bf = document.querySelector('.chat-messages');
                let ms = document.createElement('div');
                ms.classList.add('message');
                ms.innerHTML = `
                                    <div class="avatar">
                                        <img src="${e.user.URL}" alt="User 1" style="object-fit: cover;">
                                    </div>
                                    <div class="message-content">
                                        <div class="sender">${e.user.name}</div>
                                        <div class="text">${e.message}</div>
                                    </div>
                                `;
                document.querySelector("#message").value = "";
                bf.appendChild(ms);
                if (e.user.id == {{ Auth::user()->id }}) {
                    ms.querySelector('.text').classList.add('mymessage');
                }

            })

        // let btnsent = document.querySelector("#sent");
        // let message = document.querySelector("#message");

        // btnsent.addEventListener('click', function(e) {
        //     axios.post('{{ route('postMessage') }}', {
        //             message: message.value
        //         })
        //         .then(function(response) {
        //             // console.log(response.data);
        //         })
        //         .catch(function(error) {
        //             console.error('Error:', error);
        //         });
        // });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector("#message").addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    if (this.value.trim() !== "") {
                        sendchat();
                    }
                }
            });
        });
    </script>
@stop
