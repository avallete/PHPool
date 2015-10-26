$(document).ready(function(){

	$(".ship").click(function (e){
		elem = $(this);
		rel = elem.data('ship');
		elem.attr('class', 'actif');
		$.post('Moves.php', { 'ship':rel, 'movenb':5 }, function(data){
			console.log(data.x);
			elem.parent().css('left', data.x);
			elem.parent().css('top', data.y);
			console.log(elem.parent().css('left'));
		}, 'json');

	});

});