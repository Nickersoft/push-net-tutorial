<html>
<head>
  <title>Push.js FCM Demo</title>
  <link rel="manifest" href="/manifest.json">
</head>

<body>
  Loading...
  <script src="https://www.gstatic.com/firebasejs/4.1.2/firebase-app.js"></script>
  <script src="https://www.gstatic.com/firebasejs/4.1.2/firebase-messaging.js"></script>
  <script src="push.min.js"></script>
  <script src="push.fcm.min.js"></script>
  <script>
    /**
      * Sends a token to server
      */
    function sendTokenToServer(token, callback) {
      var http = new XMLHttpRequest();
      var url = "endpoint.php";
      var params = "token=" + token;

      http.open("POST", url, true);

      //Send the proper header information along with the request
      http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      http.onreadystatechange = function() { //Call a function when the state changes.
          if(http.readyState == 4 && http.status == 200) {
              console.log(http.responseText);
          }
      }
      console.debug('Sending token ' + token + ' to server...');
      document.write('Now sending Push.js FCM Instance ID to server. You should be receiving a message in exactly 10 seconds. If you go to another tab, the message will be received as a notification. Otherwise, the message payload will be posted below.<br/><br/>');
      http.send(params);
    }

    /**
      * Runs when the webpage receives a message from the server
      */
    function onMessage(payload) {
      document.write("Message received: " + JSON.stringify(payload));
    }

    // This is the Firebase config that Push will use
    var config = {
      apiKey: "",
      authDomain: "",
      databaseURL: "",
      projectId: "",
      storageBucket: "",
      messagingSenderId: "",
      sendTokenToServer: sendTokenToServer,
      onMessage: onMessage
    };

    // Configure Push
    Push.config({
      FCM: config
    });

    // Initialize Firebase
    Push.FCM();
  </script>
</body>
</html>
