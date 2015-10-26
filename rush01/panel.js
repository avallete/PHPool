function create_button(type, rel, phase)
{
	if (phase == "PP")
	{
		ndiv = $("<button/>", {
		});
		ndiv.html(type);
		ndiv.click(function(){
			$.post('pp.php', {'set_pp':type, 'ship':rel, 'submit':'set'}, function (){
				$.post('print_panel.php', {'ship':rel}, function(data){
					create_ship_panel(data, rel, phase);
				}, 'json');
			})
		})
		return (ndiv);
	}
}
function create_wbutton(weapon, rel, phase)
{
	if (phase == "PP")
	{
		ndiv = $("<button/>", {
		});
		ndiv.html('add');
		ndiv.click(function(){
			$.post('weapon_set.php', {'weapon':weapon, 'ship':rel, 'submit':'set_weapon'}, function (){
				$.post('print_panel.php', {'ship':rel}, function(data){
					create_ship_panel(data, rel, phase);
				}, 'json');
			})
		})
		return (ndiv);
	}
}

function create_ship_panel(ship, rel, phase)
{
	var name = $('#shipname');
	var stats = $('#shipstats');
	var weapons = $('#shipweapons');
	weapons.html("");
	stats.html("");
	name.html("");
	name.append('<p id=shipN >'+ship.stats.Name+'('+rel+')</p>');
	stats.append('<p id=shipM>Manoeuvre: '+ship.stats.Manoeuvre+'</p>');
	stats.append('<p id=shipPP>PP: '+ship.stats.PP+'</p>');
	stats.append('<p id=shipPV>PV: '+ship.stats.PV+'</p>');
	stats.append(create_button('pp_set_repair', rel, phase));
	stats.append('<p id=shipShield>Shield: '+ship.stats.Shield+'</p>');
	stats.append(create_button('pp_set_shield', rel, phase));
	stats.append('<p id=shipVitesse>Vitesse: '+ship.stats.Vitesse+'</p>');
	stats.append(create_button('pp_set_speed', rel, phase));
	weapons.append('<p id=shipWeapons>Weapons: </p>');
	for (w in ship.weapons)
	{
		weapons.append('<p>Name: '+ship.weapons[w].Name+'</p>');
		weapons.append('<p id=shipCharges>Charges: '+ship.weapons[w].Charges+'</p>');
		weapons.append(create_wbutton(ship.weapons[w].id, rel, phase));
		weapons.append('<p>Range short: '+ship.weapons[w].Range['short']+'</p>');
		weapons.append('<p>Range mid: '+ship.weapons[w].Range['mid']+'</p>');
		weapons.append('<p>Range long: '+ship.weapons[w].Range['long']+'</p>');
	}
}
$(document).ready(function(){
	$(".ship").click(function prompt_ship(e){
		elem = $(this);
		rel = elem.data('ship');
		var phase;
		$.post('phases.php', {'submit':'get'}, function(data){
			phase = data;
		});
		$.post('print_panel.php', { 'ship':rel }, function(data)
		{
			create_ship_panel(data, rel, phase);
			elem.attr("class", 'actif');
		}, 'json');
	});
	$("#save").click(function(){
		$.post('save_game.php', {'submit':'delete', 'player':"toto1"}, function(data){
		})
	});
	$("#PhaseName").html(function(){
			$.post('phases.php', {'submit':'get'}, function(data){
				 $("#PhaseName").html(data);
		})
	});
	$("#ChangePhase").click(function(){
		if (confirm("You want change phase ?"))
		{
			$.post('phases.php', {'submit':'next'}, function(data){
				$.post('phases.php', {'submit':'get'}, function(data)
				{
					$("#PhaseName").html(data);
				 	var name = $('#shipname');
					var stats = $('#shipstats');
					var weapons = $('#shipweapons');
					weapons.html("");
					stats.html("");
					name.html("");
				});
			});
		}
	});
});