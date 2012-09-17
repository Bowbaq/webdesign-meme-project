/* 
 *= require libs/jquery
 *= require plugins
 *= require transit.min
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

$('.joke-body').click(function() {
    var $this = $(this);
    var height = $this.children().first().outerHeight();
    
    $this.toggleClass('click-me dont-click-me');
    $this.toggleClass('open closed');
    
    if ($this.hasClass('closed')) {
        $this.transition({
            height: '30px'
        });
    } else if ($this.hasClass('open')) {
        $this.transition({
            height: height + 'px'
        }, height + 600);
    }
});

