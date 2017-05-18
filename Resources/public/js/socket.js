$(function() {

  function SocketNotifications(url) {
    this.init = function() {
      this.webSocket = WS.connect(url);

      this.webSocket.on("socket/connect", function(session) {
        session.subscribe('/' + window.user + '/notifications', function(uri, payload) {
          var event = $.Event('notification');
          $(window).trigger(event, payload.view);
        });
      });

      this.webSocket.on("socket/disconnect", function(error) {
        console.log(error);
      });
    }
  }

  window.socket_notifications = new SocketNotifications("ws://localhost:8888");
  window.socket_notifications.init();

});