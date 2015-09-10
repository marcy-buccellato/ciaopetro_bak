// By Vicky J K Lamburn - vicky.lamburn@googlemail.com

$(document).ready(function() {

	$('#sidebar-Marker').after('<div id="side-bar"></div>');
	var sidebarOrder=$.cookie('worthingGovUkSBar');
	var sidebarObjects = new Array;

	var getSideBarCode=function(get_url,gadget){
		$.ajax({
			url: get_url,
			datatype: 'html',
			async: true,
			success: function(html){
						
   						$(gadget).append(html);
						var gadgetHeadId=gadget+'Head';
						$(gadgetHeadId).prepend('<button class="gadgetClose" onclick="$(\''+gadget+'\').remove(); serial = $.SortSerialize(\'side-bar\'); $.cookie(\'worthingGovUkSBar\', serial.hash, { expires: 7 });"><img src="cross.png" title="Hide this gadget" alt="Hide"/></button>');
						}
		});
	};


	if(sidebarOrder==null)
	{
		alert('New Cookie Created: Will last for 7 days. Creating default gadgets and order');
		
		$('#side-bar').append('<div id="refuse" class="sortableitem"></div>');
		getSideBarCode('refuse.html','#refuse');
		$('#side-bar').append('<div id="news" class="sortableitem"></div>');
		getSideBarCode('news.html','#news');
		$('#side-bar').append('<div id="events" class="sortableitem"></div>');
		getSideBarCode('events.html','#events');
		$('#side-bar').append('<div id="weather" class="sortableitem"></div>');
		getSideBarCode('weather.html','#weather');
	}
	else
	{
		var sidebarOrderArray=sidebarOrder.split('&');
		var i=0;
		var gadgetId='';

		for(i=0;i<sidebarOrderArray.length;i++)
		{
			var sidebarElementInternalName=sidebarOrderArray[i].split("=")[1]
			if(sidebarElementInternalName!=null)
			{
				$('#side-bar').append('<div id="'+sidebarElementInternalName+'" class="sortableitem"></div>');
				getSideBarCode(sidebarElementInternalName+'.html','#'+sidebarElementInternalName);
			}
		}
	}
	$('#side-bar').after('<div id="add-gadget"><a href="sortables_add.html">Add New Gadgets</a></div>');

	$('#side-bar').Sortable(
			{
			accept : 		'sortableitem',
			helperclass : 		'sorthelper',
			activeclass : 		'sortableactive',
			hoverclass : 		'sortablehover',
			opacity: 		0.8,
			fx:			200,
			axis:			'vertically',
			opacity:		0.4,
			revert:			true,
			onChange : function()
				{
					serial = $.SortSerialize('side-bar');
					$.cookie('worthingGovUkSBar', serial.hash, { expires: 7 });
				}
			}
		);	
	});		
