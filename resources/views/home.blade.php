@extends('layouts.app')
@section('content')
    <form   id="myForm">
        <input type="hidden"  name="receiver_id" id="r_id">

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
                    <div class="col-md-6 ">
                        <div class="card card-bordered messages">
                            <div class="card card-bordered">
                                <div class="card-header">
                                    <h4 class="card-title"><strong>Chat</strong></h4>
                                    <a class="btn btn-xs btn-secondary" href="#" data-abc="true">Let's Chat App</a>
                                </div>
                                <div class="ps-container ps-theme-default ps-active-y text-center" id="chat-content"
                                     style="overflow-y: scroll !important; height:400px !important;">
                                    <h3>Let talk 🙂</h3>
                                </div>
                            </div>
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
            $('#r_id').val(receiver_id);
            $.ajax({
                url: "{{ route('list') }}",
                type: "post",
                data: {
                    _token: $('input[name="_token"]').val(),
                    receiver_id: receiver_id,
                },
                success:function (data)
                {
                     $('.messages').html(data.html);
                }
            })
        })

        $('body').on('submit','#myForm',function (e){
            e.preventDefault();
           let reciever_id =  $('#r_id').val();
           let message = $('.msg').val();
            var form = $('#myform')[0];
            var data = new FormData(form);
           $.ajax({
                 url:"{{ route('home.createChat') }}",
                 type:'post',
                 data:{
                     message:message,
                     _token: $('input[name="_token"]').val(),
                     reciever_id:reciever_id,
                 },
                 success:function (data)
                 {
                     $('.messages').scrollTop($('.messages')[0].scrollHeight);
                     $('.lst_p p:last').after('<p>'+data+'</p>');
                      $('.msg').val('');
                 }
           })
        })
    </script>
@endsection
