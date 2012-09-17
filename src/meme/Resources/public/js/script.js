/* 
 *= require libs/jquery
 *= require plugins
 *= require transit.min
 */

jQuery(function($) {

});

$('.joke-knock-up').click(function() {
    var $this = $(this);
    var id = $this.attr('data-joke-id');
    
    $.ajax({
        type: "POST",
        url: "/vote/up/" + id
    }).done(function(data) {
        var topbar = $this.closest('.joke-topbar');
        var score = $this.next();
        if ("ok" === data.status) {
            score.text(' (+' + data.votes + ')');
            topbar.addClass('success');
            
            setTimeout(function() {
                this.topbar.removeClass('success');
            }.bind(topbar), 3000);
        } else {
            topbar.addClass('failure');
            
            setTimeout(function() {
                this.removeClass('failure');
            }.bind(topbar), 3000);
        }
    });
});

$('.joke-knock-down').click(function() {
    var $this = $(this);
    var id = $this.attr('data-joke-id');
    
    $.ajax({
        type: "POST",
        url: "/vote/down/" + id
    }).done(function(data) {
        var topbar = $this.closest('.joke-topbar');
        var score = $this.next();
        if ("ok" === data.status) {
            score.text(' (-' + data.votes + ')');
            topbar.addClass('success');
            
            setTimeout(function() {
                this.topbar.removeClass('success');
            }.bind(topbar), 3000);
        } else {
            topbar.addClass('failure');
            
            setTimeout(function() {
                this.removeClass('failure');
            }.bind(topbar), 3000);
        }
    });
});

$('.show-more').click(function() {
    var $this = $(this);
    var parent = $this.closest('.joke-body');
    var height = parent.outerHeight();
    
    $this.removeClass("btn");
    
    if ($this.parent().next().hasClass('joke-punchline')) {
        parent.transition({
            height: $this.closest('.inner').outerHeight() + 'px'
        });
    } else {
        parent.transition({
            height: (height + 62) + 'px'
        });
    }
});