/*
 * ************************************************************* *
 * Name       : plugins                                          *
 * Date       : March 2012                                       *
 * ************************************************************* *
 */
   
$(document).ready(function($){

	$(".knob").knob();
	
	if($('#chart-mixed-1').length){
		
		var d1 = [];
		for (var i = 1; i <= 14; i += 1)
		d1.push([i, parseInt(Math.random() * 18000)]);
		
		var d2 = [];
		for (var i = 1; i <= 14; i += 1)
		d2.push([i, parseInt(Math.random() * 22800)]);
		
		var d3 = [];
		for (var i = 1; i <= 14; i += 1)
		d3.push([i, parseInt(Math.random() * 14600)]);
		
		var d4 = [];
		for (var i = 1; i <= 14; i += 1)
		d4.push([i, parseInt(Math.random() * 20900)]);
		
		$.plot("#chart-mixed-1", 
			[
				{
					label: "Merma",
					data: d1,
					lines: { show: true, fill: 0.4 },
					color: "#eb3b05",
					hoverable: true
				},
				{
					label: "Emision",
					data: d2,
					lines: { show: true, lineWidth: 4 },
					color: "#05a444"
				},
				{
					label: "Satisfacci&oacute;n",
					data: d3,
					lines: { show: true, lineWidth: 2 },
					color: "#0cbccc"
				}
			], 			
			{
				series	:	{ lines: { show: true }, points: { show: true }, curvedLines: { active: true } },
				grid	:	{ hoverable: true, clickable: false, color: '#333', borderWidth:1.0, borderColor:'#bbb'},
				legend	:	{ show: true },
				yaxis	:	{ position: "left"}
			}
		);
	}
	
	
});
