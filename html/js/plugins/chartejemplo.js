
$(document).ready(function($){

/* THIRD PARTY ----------------------------------------------------------- */

	/**
	 * Name        : Flot
	 * Description : Plotting library 
	 * File Name   : flot.js
	 * Plugin Url  : http://www.flotcharts.org/
	 * Updated     : --/--/----	
	 * Dependency  : jQuery core
	 * Developer   : Brandon
	**/	

	/* chart 2 */
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
					label: "ThemeForest",
					data: d1,
					lines: { show: true, fill: 0.4 },
					color: "#bbb",
					hoverable: true
				},
				{
					label: "CodeCanyon",
					data: d2,
					lines: { show: true, lineWidth: 4 },
					color: "#666"
				},
				{
					label: "GaphicRiver",
					data: d3,
					lines: { show: true, lineWidth: 2 },
					color: "#ccc"
				},
				{
					label: "PhotoDune",
					data: d4,
					lines: { show: true, lineWidth: 2 },
					color: "#999"
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