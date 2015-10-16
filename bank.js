$(function(){
	$('.json').click(function(){
		$('.hide').dialog({
			width: "600px",
			show: "explode",
			title: "json",
			buttons: [
				{
					text: "Закрыть",
					click: function() {
						$(this).dialog("close");
					}
				}
			]
		});
	});
});