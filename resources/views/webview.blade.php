<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <script src="https://connect.facebook.net/en_US/messenger.Extensions.js" type="text/javascript"></script>
    <script src="https://raw.githubusercontent.com/nicolasbeauvais/vue-social-sharing/master/dist/vue-social-sharing.min.js" type="text/javascript"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Webview</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" type="text/css">

</head>
<body>
<div id="app">
    <div>
        <simple-webview></simple-webview>
        <social-sharing url="https://reactjs.org/"
                        title="A JavaScript library for building user interfaces"
                        description="Ipsum Lorem"
                        quote="React is a progressive framework for building user interfaces.">
            <div>
                <network network="email">
                    <i class="fa fa-envelope"></i> Email
                </network>
                <network network="whatsapp">
                    <i class="fa fa-whatsapp"></i> Whatsapp
                </network>
            </div>
        </social-sharing>
    </div>
</div>
<script src="/js/app.js"></script>
</body>
</html>