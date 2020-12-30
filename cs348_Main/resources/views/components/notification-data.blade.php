<meta name="csrf-token" content="{{ csrf_token() }}">
@include('components.notification-card')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function closeMessage() {
        message.__x.$data.showMessage = false;
    }

    Echo.private('App.Models.User.{{Auth::user()->id}}')
        .notification((notification) => {
            console.log(notification.message);
        });

    Echo.private('App.Models.User.{{Auth::user()->id}}').notification((notification) => {
        let message = document.getElementById('message');
        message.__x.$data.showMessage = true;
        message.__x.$data.message = notification.message;

        setTimeout(function () {
            closeMessage()
        }, 10000);
    });

</script>
