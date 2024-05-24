@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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

        // Echo.channel("notification").listen("UserSessionChange", e => {
        //     console.log(e.user);
        //     const notiElement = document.querySelector("#notification");

        //     // Kiểm tra xem phần tử có tồn tại không
        //     if (notiElement) {
        //         notiElement.innerText = e.user;
        //         notiElement.classList.remove("invisible");
        //         // Thay vì loại bỏ tất cả các lớp, bạn có thể sử dụng `classList.replace()` để thay thế lớp cũ bằng lớp mới
        //         notiElement.classList.replace("alert-success", "alert-" + e.type);
        //         notiElement.classList.replace("alert-danger", "alert-" + e.type);
        //     } else {
        //         // Nếu phần tử không tồn tại, bạn có thể tạo nó ở đây hoặc thực hiện các hành động khác
        //         console.error("Element with ID 'notification' not found.");
        //     }
        // });
    </script>
@stop
