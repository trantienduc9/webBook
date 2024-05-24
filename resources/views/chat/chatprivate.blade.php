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
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chat-container {
            width: 400px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-weight: bold;
        }

        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 10px;
        }

        .message {
            display: flex;
            align-items: flex-end;
            margin-bottom: 15px;
            width: 65%;
            color: white;
        }

        .avatar img {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .message-content {
            flex: 1;
            background-color: #ff0d9e;
            padding: 10px;
            border-radius: 15px 5px 5px 15px;
            word-wrap: break-word;
        }

        .sender {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .input-container {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 8px 8px;
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
            background: #0084ff;
        }

        .chat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .call .video {
            margin: 0 10px;
        }

        .mspresent {
            margin-left: 132px;
        }

        .message-receiver {
            border-radius: 15px;
        }
    </style>

    <div class="container">
        <div class="chat-container">
            <div class="chat-header">
                <div class="account-info" id="link{{ $user->id }}">
                    <img class="avatar" src="{{ asset($user->URL) }}" alt="Avatar">
                    <span class="account-name">{{ $user->name }}</span>
                </div>
                <div class="call">
                    <a href=""><i class="fas fa-phone-alt"></i></a>
                    <a href="" class="video"><i class="fas fa-video"></i></a>
                    <a href="{{ route('chat') }}"><i class="fas fa-times"></i></i></a>
                </div>
            </div>
            <div class="chat-messages">
                @if(isset($message->mymessage))
                    @foreach ($message->mymessage as $item)
                        @if ($item->sender_id == Auth::user()->id)
                            <div class="message mspresent">
                                <div class="message-content mymessage">
                                    <div class="text">{{ $item->message }}</div>
                                </div>
                            </div>
                        @else
                            <div class="message">
                                <div class="avatar">
                                    <img src="{{$message->sender->URL}}" alt="User Avatar">
                                </div>
                                <div class="message-content message-receiver">
                                    <div class="text">{{ $item->message }}</div>
                                </div>
                            </div>
                        @endif
                    @endforEach
                @endif
                <!-- Additional messages go here -->
            </div>
            <div class="input-container">
                <input type="text" class="message-input" id="message" placeholder="Type your message...">
                <button class="send-button" id="sent" onclick="sendprivate()">Gửi</button>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        // gửi tin nhắn riêng
        function sendprivate() {
            axios.post("{{ route('messagePrivate', $user->id) }}", {
                    message: message.value
                })
                .then(function(response) {
                    // console.log(response);
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        }
    </script>
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
                if (element) { // Kiểm tra xem phần tử có tồn tại không trước khi tiếp tục
                    let status = element.querySelector('.status');
                    if (status) {
                        element.removeChild(status);
                    }
                }
            })
            .listen('UserOnline', e => {
                let bf = document.querySelector('.chat-messages');
                let ms = document.createElement('div');
                ms.classList.add('message');
                ms.innerHTML = `
                    <div class="avatar">
                        <img src="${e.user.URL}" alt="User Avatar">
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

        let btnsent = document.querySelector("#sent");
        let message = document.querySelector("#message");

        // btnsent.addEventListener('click', function(e) {
        //     axios.post("{{ route('messagePrivate', $user->id) }}", {
        //             message: message.value
        //         })
        //         .then(function(response) {
        //             // console.log(response);
        //         })
        //         .catch(function(error) {
        //             console.error('Error:', error);
        //         });
        // });


        Echo.private("chat.private.{{ Auth::user()->id }}.{{ $user->id }}")
            .listen("ChatPrivate", e => {
                $(".chat-messages").append(`
                        <div class="message mspresent">
                            <div class="message-content mymessage">
                                <div class="text">${e.message}</div>
                            </div>
                        </div>
                `)
                $("#message").val("");
            });
        Echo.private("chat.private.{{ $user->id }}.{{ Auth::user()->id }}")
            .listen("ChatPrivate", e => {
                console.log(e);
                $(".chat-messages").append(`

                        <div class="message">
                            <div class="avatar">
                                <img src="${e.userSend.URL}" alt="User Avatar">
                            </div>
                            <div class="message-content message-receiver">
                                <div class="text">${e.message}</div>
                            </div>
                        </div>
                `)
                $("#message").val("");
            });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector("#message").addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    if (this.value.trim() !== "") {
                        sendprivate();
                    }
                }
            });
        });
    </script>

@stop
