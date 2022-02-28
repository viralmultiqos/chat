@extends('layouts.app')
@section('content')
    <form  method="post" id="myForm">
        @csrf
        <div class="container page-content page-container" id="page-content">
            <div class="padding">

                <div class="row container d-flex justify-content-center">
                    <div class="col-md-3">
                        <ul>
                            @foreach( $users as $user)
                                @if($user->id !== auth()->user()->id)
                                    <li><a href="#" data-id="{{ $user->id }}" class="get_user">{{ $user->name}}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6 msgs">
                        <div class="card card-bordered">
                            <div class="card-header">
                                <h4 class="card-title"><strong>Chat</strong></h4>
                                <a class="btn btn-xs btn-secondary" href="#" data-abc="true">Let's Chat App</a>
                            </div>
                            <div class="ps-container ps-theme-default ps-active-y" id="chat-content"
                                 style="overflow-y: scroll !important; height:400px !important;">
                                @if($chats  != null)
                                    @foreach( $chats as $key => $value)
                                        @if(auth()->user()->id == $value['sender_id'])
                                            <div class="media media-chat media-chat-reverse">
                                                <div class="media-body">
                                                    <p>{{ $value['message'] }}</p>
                                                </div>
                                            </div>
                                        @else
                                            <div class="media media-chat"><img class="avatar"
                                                                               src="https://img.icons8.com/color/36/000000/administrator-male.png"
                                                                               alt="...">
                                                <div class="media-body">
                                                    <p>{{ $value['message'] }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="publisher bt-1 border-light">
                            <input class="publisher-input" type="text" placeholder="Write something"
                                   name="message">
                            <button type="submit" class="publisher-btn text-info" href="#" data-abc="true"><i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $('body').on('click', '.get_user', function () {
            let receiver_id = $(this).attr('data-id')
            $.ajax({
                url: "{{ route('list') }}",
                type: "get",
                data: "&receiver_id=" + receiver_id,
                success:function (data)
                {
                     $('.msgs').html(data)
                }
            })
        })

        $('body').on('submit','#myForm',function (){

        })
    </script>
@endsection
