$('#prev').on('click', function() {
  $('ul').animate({
    scrollLeft: '-=100'
  }, 300, 'swing');
});

$('#next').on('click', function() {
  $('ul').animate({
    scrollLeft: '+=100'
  }, 300, 'swing');
});