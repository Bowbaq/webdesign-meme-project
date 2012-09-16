/* 
 *= require libs/jquery
 *= require plugins
 */

jQuery(function($) {

});

$('.joke-knock-up').click(function() {
    $this = $(this);
    id = $this.attr('data-joke-id');
    
    $.ajax({
        type: "POST",
        url: "/vote/up/" + id
    }).done(function(data) {
        if ("ok" === data.status) {
            $this.text('Knock up (+' + data.votes + ')');
        } else {
            // Nothing now ...
        }
    });
});

$('.joke-knock-down').click(function() {
    $this = $(this);
    id = $this.attr('data-joke-id');
    
    $.ajax({
        type: "POST",
        url: "/vote/down/" + id
    }).done(function(data) {
        if ("ok" === data.status) {
            $this.text('Knock down (-' + data.votes + ')');
        } else {
            // Nothing now ...
        }
    });
});

$('.first-bubble').click(function() {
    $(this).next('p').show('slow', function showNext() {
        $(this).next('p').show('slow', showNext);
    });
});