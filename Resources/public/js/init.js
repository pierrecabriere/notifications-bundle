$(function() {

  var _counter = $('#notifications-counter');
  var _list = $('#notifications-list');
  var _container = $('#notifications-container');

  $(window).on('notification', function(e, view) {
    _list.prepend(view);
    var unread = +_counter.text();
    _counter.text(unread + 1);
  });

  _container.on('show.bs.dropdown', function () {
  });

});