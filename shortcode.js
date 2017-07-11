// JavaScript Document
"use strict";
var shortcode = document.getElementById('shortcode')
var atts = {
title : '',
sort_order : '',
'sort_by_values' : '',
'exclude_page_id' : '',
'depth' : 1,
};

function create_shortcode()
{
	var shortcode_string = '';
	for (var attribute in atts)
	{
		if(atts[attribute].length === 0) {
			continue;
		}
		shortcode_string+= attribute + "=" + atts[attribute]+" ";
	}
	shortcode.textContent='[subpages '+shortcode_string.trim()+']';
}

function change_attribute(field)
{
	var attribute = field.name;
	var value = field.value;
	console.log(field.getAttribute('multiple'));
	if(field.getAttribute('multiple')) {
		//console.log(field.length);
		atts[attribute]='';
		//for (var option in field.options) {
		for (var i=0, iLen=field.length; i<iLen; i++) {
			var option=field[i];
			//console.log(option);
			if(option.selected) {
				console.log('Selected '+option.value);
				atts[attribute]+=option.value+',';
			}
		}
		//Remove comma at the end
		atts[attribute] = atts[attribute].slice(0,-1);
	}
	else {
		atts[attribute]=value;
	}

	console.log(attribute);
	console.log(value);
	
	create_shortcode();
}