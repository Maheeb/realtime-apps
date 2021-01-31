@extends('layouts.app')

@push('styles')

    <style type="text/css">
        @keyframes rotate {
            from {

                transform: rotate(0deg)
            }

            to {

                transform: rotate(360deg)
            }

        }

        .refresh {

            animation: rotate 1.5s linear infinite;
        }

    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                {{-- <a href="/start" class="btn btn-success">Start</a> --}}

                    <div class="card-header">Game</div>

                    <div class="card-body">

                        <div class="text-center">
                            <img id="circle" height="250" class="" width="250" src="{{ asset('img/circle.png') }}" alt="">
                            <p id="winner" class="display-1 d-none text-primary"></p>
                        </div>
                        <hr>

                        <div class="text-center">

                            <label class="font-weight-bold h5">Your guess</label>

                            <select class="custome-select col-auto" name="" id="guess">
                                <option selected>Not in</option>
                                @foreach (range(1, 12) as $number)
                                    <option>{{ $number }}</option>
                                @endforeach
                            </select>

                            <hr>
                            <p class="font-weight-bold h5">Remaining Time</p>

                            <p id="timer" class="h5 text-danger">Waiting to start</p>

                            <hr>

                            <p id="result" class="h1"></p>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





@push('scripts')
    <script>
        const circleElement = document.getElementById('circle');

        console.log(circleElement)
        const timerElement = document.getElementById('timer');
        const winnerElement = document.getElementById('winner');
        const guessElement = document.getElementById('guess');
        const resultElement = document.getElementById('result');

        Echo.channel('game')
            .listen('RemainingTImeChanged', (e) => {
                timerElement.innerText = e.time;

                // console.log(e.time)

                circleElement.classList.add('refresh');
                winnerElement.classList.add('d-none');

                resultElement.innerText = '';

                resultElement.classList.remove('text-success');
                resultElement.classList.remove('text-danger');


            })


            .listen('WinnerNumberChanged', (e) => {


                circleElement.classList.remove('refresh');

                let winner = e.number;
                winnerElement.innerText = winner;
                winnerElement.classList.remove('d-none');

                let guess = guessElement[guessElement.selectedIndex].innerText;

                if (guess == winner) {

                    resultElement.innerText = "You win";
                    resultElement.classList.add('text-success');
                } else {

                    resultElement.innerText = "You lose";
                    resultElement.classList.add('text-danger');
                }


            })

    </script>

@endpush
