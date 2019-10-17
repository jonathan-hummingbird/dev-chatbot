<template>
    <div>
        <h1>THIS IS A SIMPLE WEBVIEW</h1>
        <button @click="customOnDestroy">CLOSE WEBVIEW</button>
        <button @click="customOnShare">SHARE WITH SOMEONE</button>
    </div>
</template>

<script>
    import SocialSharing from "vue-social-sharing";

    export default {
        methods: {
            customOnDestroy() {
                if (MessengerExtensions && MessengerExtensions.requestCloseBrowser) {
                    MessengerExtensions.requestCloseBrowser(data => {
                        alert("Help I am being destroyed");
                        console.log("Hooray I am being destroyed");
                        console.log("Data is ", data);
                    });
                }
            },
            customOnShare() {
                if (MessengerExtensions && MessengerExtensions.beginShareFlow && MessengerExtensions.requestCloseBrowser) {
                    const message = {
                        "attachment": {
                            "type": "template",
                            "payload": {
                                "template_type": "generic",
                                "elements": [{
                                    "title": "Generic Webview",
                                    "image_url": "https://images.unsplash.com/photo-1571252442383-a25e8e34c2f8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80",
                                    "subtitle": "Sample Webview with Image",
                                    "default_action": {
                                        "type": "web_url",
                                        "url": "https://unsplash.com"
                                    },
                                    "buttons": [{
                                        "type": "web_url",
                                        "url": "https://unsplash.com/photos/xLmKdIcHbmw",
                                        "title": "View Actual Image"
                                    }]
                                }]
                            }
                        }
                    };
                    MessengerExtensions.beginShareFlow(
                        (share_response) => {
                            console.log("Share response received ", share_response);
                            alert("Shared correctly!!!");
                            MessengerExtensions.requestCloseBrowser();
                        },
                        (error_code, error_message) => {
                            console.log("Error in sharing item. Code: ", error_code);
                            console.log("Error in sharing item. Message: ", error_message);
                            alert("Shared Failed!!!");
                        },
                        message,
                        "broadcast"
                    );
                }
            }
        },
        // mounted() {
        //     let facebook_script = document.createElement('script');
        //     facebook_script.setAttribute('src', 'https://connect.facebook.net/en_US/messenger.Extensions.js');
        //     document.head.appendChild(facebook_script);
        // },
        beforeDestroy() {
            this.customOnDestroy();
        }
    }
</script>