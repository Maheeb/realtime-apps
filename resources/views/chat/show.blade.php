@extends('layouts.app')

@push('styles')

    <style type="text/css">
        /* @keyframes rotate {
                        from {

                            transform: rotate(0deg)
                        }

                        to {

                            transform: rotate(360deg)
                        }

                    }

                    .refresh {

                        animation: rotate 1.5s linear infinite;
                    } */

    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">

                    {{-- <a href="/start" class="btn btn-success">Start</a> --}}

                    <div class="card-header">Chat</div>

                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12 border rounded-lg p-3">

                                        <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh">
                                            <li>Test1: hello</li>
                                            <li>Test2: Hi there</li>
                                        </ul>
                                    </div>
                                </div>
                                <form action="">
                                    <div class="row py-3">
                                        <div class="col-10">
                                            <input type="text" id="message" class="form-control">
                                        </div>
                                        <div class="col-2">
                                            <button id="send" type="submit" class="btn btn-primary btn-block">Send</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="col-2">

                                <p><strong>Online now</strong></p>

                                <ul id="users" class="list-unstlyed overflow-auto text-info" style="height: 45vh">
                                    {{-- <li>Test1</li>
                                    <li>Test2</li> --}}
                                </ul>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





@push('scripts')
    <script>
        const userElement = document.getElementById('users');
        const messageElement = document.getElementById('messages');
        Echo.join('chat')
            .here((users) => {
                users.forEach((user, index) => {
                    let element = document.createElement('li');
                    element.setAttribute('id', user.id);
                    element.innerText = user.name;
                    userElement.appendChild(element);
                });
            })
            .joining((user) => {

                let element = document.createElement('li');
                element.setAttribute('id', user.id);
                element.innerText = user.name;
                userElement.appendChild(element);
            })
            .leaving((user) => {

                const element = document.getElementById(user.id);
                element.parentNode.removeChild(element);

            })
            .listen('MessageSent',(e)=>{
                let element = document.createElement('li');
                element.innerText = e.user.name +':'+ e.message;

                messageElement.appendChild(element);

            })

    </script>


    <script>
        const msgElement = document.getElementById('message');
        const sendElement = document.getElementById('send');

        sendElement.addEventListener('click', (e) => {
            e.preventDefault();

            window.axios.post('/chat/message', {

                message: msgElement.value,


            })

            msgElement.value='';
        });

    </script>

@endpush
