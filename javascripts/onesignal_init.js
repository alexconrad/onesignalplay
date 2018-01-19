
var OneSignal = window.OneSignal || [];
OneSignal.push(["init", {
    appId: "[[[APP_ID]]]",
    notifyButton: {
        enable: false /* Set to false to hide */
    },
    autoRegister: false, /* Set to true to automatically prompt visitors */
    httpPermissionRequest: {
        enable: true
    },
    welcomeNotification: {
        disable: true
    },
    promptOptions: {
        // actionMessage limited to 90 characters
        actionMessage: "Yall want some of them pushes ?",
        // acceptButtonText limited to 15 characters
        acceptButtonText: "HIT ME UP BRUH",
        // cancelButtonText limited to 15 characters
        cancelButtonText: "NAH, GO AWAY"
    },
    webhooks: {
        cors: false,
        'notification.displayed': 'https://ssl.atami.ro/hooks.php?a=displayed',
        'notification.clicked': 'https://ssl.atami.ro/hooks.php?a=clicked',
        'notification.dismissed': 'https://ssl.atami.ro/hooks.php?displayed?a=dismissed'
    }
    /*
    ,
    welcomeNotification: {
        "title": "Atami",
        "message": "Thanks yo"
    },
    */
}]);

OneSignal.push(function() {

    OneSignal.log.setLevel('trace');

    OneSignal.on('subscriptionChange', function(isSubscribed) {
        console.log('subscription change');
        if (isSubscribed) {
            // The user is subscribed
            //   Either the user subscribed for the first time
            //   Or the user was subscribed -> unsubscribed -> subscribed
            OneSignal.getUserId( function(userId) {
                $.ajax({
                    method: "POST",
                    url: "player.php",
                    data: { userid: userId}
                })
                    .done(function( msg ) {
                        //$('#playerok').css('display','block');
                        //$('#playerok').text('You are now subscribed '+userId);
                    });
            });
        }else{
            //do unsubscribe
        }
    });

    //console.log('start');
    OneSignal.showHttpPrompt();//.then(function (qwe) { console.log(qwe);});
    //console.log('end');
    //console.log(blah);
    //blah.then(function (qwe) { console.log(qwe);});
});

