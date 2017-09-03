$(document).on('click', 'a.tab', function(){
    var self = $(this);
    var $container = $(self.attr('href'));
    $.get(
        window.location.pathname,
        {
            type: self.attr('data-type')
        },
        function(data){
            $container.html(data);
        }
    );
});
