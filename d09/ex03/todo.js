function create_div(value, rel)
{
	var list = $('#ft_list');
	var ndiv = $('<div/>', {
		rel: rel,
		class: 'elem'});
	ndiv.html(value);
	ndiv.click(function(){
		if (confirm('Are you sure ??'))
		{
			$.post('delete.php', { 'id':rel }, function(data){
			})
			$(this).remove();
		}
		});
	list.prepend(ndiv);	
}
$("#add").click(function (e){
	e.preventDefault();
	var newname = prompt("Name of new todo: ");
	var rel = 'cookie' + new Date().getTime();
	if (newname && newname != "")
	{
		create_div(newname, rel);
		$.post('insert.php', { 'id':rel, 'value':newname }, function(data){console.log(data);
		});
	}
})

function print_alert(value)
{
	alert(value);
	console.log(value);
}
function print_cookies(){
	$.post('select.php', function(data){
		for (c in data)
			create_div(data[c], c);
	}, 'json');
}
$(document).ready(function(){
	print_cookies();
})