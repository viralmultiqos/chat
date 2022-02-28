<div class="card card-bordered">
    <div class="card-header">
        <h4 class="card-title"><strong>{{ $user->name }}</strong></h4>
        <a class="btn btn-xs btn-secondary" href="#" data-abc="true">Let's Chat App</a>
    </div>
    <div class="ps-container ps-theme-default ps-active-y" id="chat-content"
         style="overflow-y: scroll !important; height:400px !important;">
        @if($chats  != null)
            @foreach( $chats as $key => $value)
                @if(auth()->user()->id == $value['sender_id'] && $receiver_id == $value['receiver_id'])
                    <div class="media media-chat media-chat-reverse">
                        <div class="media-body lst_p">
                            <p>{{ $value['message'] }}</p>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->id == $value['receiver_id'] && $receiver_id == $value['sender_id'])
                    <div class="media media-chat"><img class="avatar"
                                                       src="https://img.icons8.com/color/36/000000/administrator-male.png"
                                                       alt="...">
                        <div class="media-body " >
                            <p>{{ $value['message'] }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
</div>
<div class="publisher bt-1 border-light">
    <input class="publisher-input msg" type="text" placeholder="Write something"
           name="message" required>
    <button type="submit" class="publisher-btn text-info" href="#" data-abc="true"><i
            class="fa fa-paper-plane"></i></button>
</div>
