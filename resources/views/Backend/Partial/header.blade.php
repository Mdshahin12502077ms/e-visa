  <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('Backend/assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('Backend/assets/images/logo-dark.png')}}" alt="" height="17">
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('Backend/assets/images/logo-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{asset('Backend/assets/images/logo-light.png')}}" alt="" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

                <!-- App Search-->
                {{--    --}}
            </div>

            <div class="d-flex align-items-center">





                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

               <div class="dropdown ms-1 header-item d-none d-sm-flex">
                    <button type="button" id="notificationButton" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle position-relative" data-bs-toggle="dropdown">
                        <i class="bx bx-bell fs-22"></i>
                        <span id="notificationBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger " >
                            <span id="notificationCount" class="notificationCount"></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-2" aria-labelledby="notificationButton" style="min-width: 300px; max-height: 300px; overflow-y: auto;" id="notificationDropdown">
                        <h6 class="dropdown-header">Notifications</h6>
                        <div id="notificationList">

                        </div>
                    </div>
                </div>

                <div class="dropdown ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle position-relative" id="messageButton" data-bs-toggle="dropdown">
                        <i class="bx bx-chat fs-22"></i>
                        <span id="messageBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <span id="messageCount" class="messageCount"></span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-2" style="min-width: 300px; max-height: 300px; overflow-y: auto;" id="messageDropdown">
                        <h6 class="dropdown-header">Messages</h6>
                        <div id="messageList">

                        </div>
                    </div>
                </div>






                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                          <img class="rounded-circle header-profile-user"
                                src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('Backend/assets/images/users/avatar-1.jpg') }}"
                                alt="Header Avatar">

                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->name }}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome Anna!</h6>
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>


                        <a class="dropdown-item" href="{{route('logout')}}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
  <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/laravel-echo/dist/echo.iife.js"></script>
 <script src="https://js.pusher.com/7.0/pusher.min.js"></script>



 <script>

document.addEventListener('DOMContentLoaded', () => {
    let userId = "{{ auth()->id() }}";

    const EchoConstructor = window.Echo.default;
    window.Echo = new EchoConstructor({
        broadcaster: 'reverb',
        key: "{{ config('broadcasting.connections.reverb.key') }}",
        wsHost: 'localhost',
        wsPort: 8080,
        wssPort: 8080,
        scheme: 'http',
        forceTLS: false,
        enabledTransports: ['ws', 'wss'],
    });

    window.Echo.private(`notification${userId}`)
        .listen('NotificationUser', (e) => {
            console.log("📢 Notification:", e);

            // Show the badge
            let badge = document.getElementById('notificationBadge');
            let countSpan = document.getElementById('notificationCount');
            let count = parseInt(countSpan.innerText) || 0;
            count++;
            countSpan.innerText = count;
            badge.style.display = 'inline-block';


           toastr.warning(e.message, 'Notification');
        });




function getnotification(){
    $.ajax({
        url: "{{ route('get.notification') }}",
        type: "GET",
        dataType: "json",
        success: function(response) {
            let count=response.count;
            $('.notificationCount').text(count);

            let notification=response.notification;
            notification.forEach(notification => {
                 let date = new Date(notification.created_at);

                let options = {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                };

                let formattedDate = date.toLocaleString('en-US', options);
                    $('#notificationList').append(`
                        <a href="/notification/show/${notification.id}" class="dropdown-item notify-item border-bottom py-2">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar-xs bg-primary text-white rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bx bx-bell"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 text-dark fw-semibold">${notification.title}</h6>
                                    <div class="text-muted small">
                                        <span>${notification.comment.substring(0,45)+'......'}</span>
                                        <div><i class="mdi mdi-clock-outline me-1"></i> ${formattedDate}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `);

            });
        }
    });
 }

 getnotification();








function getMessegeNotification() {
    $.ajax({
        url: "{{ route('get.messege.notification') }}",
        type: "GET",
        success: function(response) {
            let messages = response.messsegs;
             console.log(messages);
            $('#messageList').empty();
            $('.messageCount').text(messages.length);

            messages.forEach(msg => {
               let friendId = msg.sender_id === parseInt("{{ auth()->id() }}") ? msg.receiver_id : msg.sender_id;
               let conversationId = [msg.sender_id, msg.receiver_id].sort((a, b) => a - b).join('-');
               console.log(friendId);
                $('#messageList').append(`
                    <a href="/chat/${friendId}" class="dropdown-item notify-item border-bottom py-2">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs bg-success text-white rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bx bx-user"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 text-dark fw-semibold">${msg.receiver.name}</h6>
                                <div class="text-muted small">${msg.message}</div>
                            </div>
                        </div>
                    </a>
                `);
            });

            // badge show/hide
            let badge = document.getElementById('messageBadge');
            badge.style.display = messages.length > 0 ? 'inline-block' : 'none';
        }
    });
}
getMessegeNotification();



window.Echo.private(`messege.${conversationId}`)
    .listen('ChatEvent', (e) => {
        console.log("📥 Real-time:", e);

        const isOwnMessage = parseInt(userId) === e.chat.sender_id;

        // যদি নিজের message হয় তাহলে আবার fetchMessages() না করি
        if (!isOwnMessage) {
            chatBox.innerHTML += `
                <div class="mb-2 text-start">
                    <span class="badge fs-4 bg-secondary">${e.chat.message}</span>
                </div>
            `;
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });




});
</script>
