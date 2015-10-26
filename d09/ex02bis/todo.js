function setCookie(sName, sValue) {
        var date = new Date();
        date.setTime(date.getTime() + (60*60*1000));
        document.cookie = sName + "=" + encodeURIComponent(sValue) + ";expires=" + date.toGMTString();
}
function getCookie(sName) {
        var cookContent = document.cookie, cookEnd, i, j;
        var sName = sName + "=";
 
        for (i=0, c=cookContent.length; i<c; i++) {
                j = i + sName.length;
                if (cookContent.substring(i, j) == sName) {
                        cookEnd = cookContent.indexOf(";", j);
                        if (cookEnd == -1) {
                                cookEnd = cookContent.length;
                        }
                        return decodeURIComponent(cookContent.substring(j, cookEnd));
                }
        }       
        return null;
}

function create_div(value, rel)
{
	var list = $('#ft_list');
	var ndiv = $('<div/>', {
		rel: rel,
		class: 'elem'});
	ndiv.html(value);
	ndiv.click(function(){
		if (confirm('Are you sure ?')) {
			document.cookie = $(this).attr('rel') + "=; Max-Age=0";
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
		setCookie(rel, newname);
	}
})
function listCookies() {
   var theCookies = document.cookie.split(';');
   var ret = {};
   var regex = new RegExp("^.*cookie*");
   for (var i = 0; i < theCookies.length; i++) {
   		cookie = theCookies[i].split('=');
   		if (regex.test(cookie[0])){
   			ret[cookie[0].replace(/^ /, '')] = cookie[1];
   		}
   }
   return ret;
}
function print_alert(value)
{
	alert(value);
	console.log(value);
}
function print_cookies(){
	var cookies = listCookies();
	for (c in cookies) {
		create_div(cookies[c], c);
	}
}
$(document).ready(function(){
	print_cookies();
})
