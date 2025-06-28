@extends('Backend.master')

@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- Chat Layout -->
            <div class="card" style="max-width: 700px; margin: auto;">
                <!-- USER LIST TOP -->
                <div class="card-header bg-light border-bottom py-2" style="overflow-x: auto; white-space: nowrap;">
                    @foreach($users as $user)
                        <a href="{{ url('/chat/user/' . $user->id) }}" class="d-inline-block text-center mx-2">
                            <div class="avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" style="width: 50px; height: 50px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <small class="d-block mt-1">{{ Str::limit($user->name, 6) }}</small>
                        </a>
                    @endforeach
                </div>

                <!-- CHAT BODY -->
                <div class="card-body d-flex flex-column p-0" style="height: 500px;">
                    <div id="chatBox" class="flex-grow-1 p-3 overflow-auto" style="background: #f0f2f5;"></div>

                    <form id="chatForm" class="border-top p-3 bg-white">
                        <input type="hidden" id="receiver_id" value="{{ $receiverId }}">
                        <div class="input-group">
                            <input type="text" id="message" class="form-control" placeholder="Type a message..." name="messege">
                            <button type="button" class="btn btn-primary sendmessege">Send</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection



    @push('scripts')
    {{--  <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>  --}}

    <script>

        const userId = "{{ auth()->id() }}";
        const receiverId = document.getElementById('receiver_id').value;
        const conversationId = userId < receiverId ? `${userId}-${receiverId}` : `${receiverId}-${userId}`;
        const chatBox = document.getElementById('chatBox');


    ////////////data fetch//////////
        function fetchMessages() {
            $.ajax({
                url:`{{ url('/chat/fetch-messages') }}/${conversationId}`,
                type: 'GET',
                success: function(response){
                    let chat=response.chat;
                    chatBox.innerHTML = '';
                    chat.forEach(function(message) {
                        chatBox.innerHTML += `
                            <div class="mb-2 ${message.sender_id == userId ? 'text-end' : 'text-start'}">
                                <span class="badge fs-4 ${message.sender_id == userId ? 'bg-primary' : 'bg-secondary'}">${message.message}</span>
                            </div>
                        `;
                    });
                chatBox.scrollTop = chatBox.scrollHeight;
                },
            });
        }
    fetchMessages();

    /////////////send message//////////

    $(document).on('click', '.sendmessege', function(e) {
        e.preventDefault();

        let messege = $('input[name="message"]').val();
        let receiver_id = receiverId;

        $('.text-danger').remove();

        if (messege === '') {
            $('input[name="message"]').after('<span class="text-danger">Please enter a message</span>');
            return;
        }

        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        let formdata = new FormData($('#chatForm')[0]);
        formdata.append('receiver_id', receiver_id);

        $.ajax({
            url: "{{route('send.messege')}}",
            type: 'POST',
            data: formdata,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                fetchMessages(); // assuming this is defined somewhere
                $('input[name="message"]').val(''); // clear message box
                $('.#chatForm').trigger('reset'); // reset form
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });





    </script>
    @endpush
