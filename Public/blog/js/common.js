function initForm(remarks) {
	var currentRemarkElement;
	
	for (var elementName in remarks) {
		var elements = document.getElementsByName(elementName);
		
		for (var i = 0; i < elements.length; i ++) {
			var clickEventListener = function(evt) {
				var obj;
				
				if (evt.srcElement) {
					obj = evt.srcElement;
				} else {
					obj = this;	
				}
				
				if (currentRemarkElement) {
					currentRemarkElement.innerHTML = "";
				}
			
				var errorElement = document.getElementById(obj.name + "_error");
				var remarkElement = document.getElementById(obj.name + "_remark");
				remarkElement.innerHTML = remarks[obj.name];
				remarkElement.style.display = "inline";
				currentRemarkElement = remarkElement;
				if(errorElement){
					errorElement.innerHTML = "";
				}
			}
			
			if (window.addEventListener) {
				elements[i].addEventListener('click', clickEventListener, false);	
			} else {
				elements[i].attachEvent('onclick', clickEventListener);	
			}
		}
	}
}

function loadOptions(url, select, proc) {
	$.getJSON(url, function(data) {
		select.options.length = 0;
		for (var i = 0; i < data.length; i++) {
			var obj = data[i];
			var option = document.createElement("option");
			select.options.add(option);
			option.value = obj.typeid;
			
			option.innerHTML = obj.type_name;
		}
		
		if (proc) {
			proc(parseInt(data[0].typeid));
		}
	});
}

function loadCorpOptions(url, select, proc) {
	$.getJSON(url, function(data) {
		select.options.length = 1;
		for (var i = 0; i < data.length; i ++) {
			var obj = data[i];
			var option = document.createElement("option");
			select.options.add(option);
			option.value = obj.corpid;
			option.innerHTML = obj.corpname;
		}
		
		var option = document.createElement("option");
		select.options.add(option);
		option.value = 0;
		option.innerHTML = "other";

		proc(select);
	});
}

/*
	region_type:1=>省，2=>市，3=>区
	objId:调用位置的控件id
	parent_value:上级region id
	check_value:默认选中的region id
*/
/* load region */
function LoadRegion(region_type,objId,parent_value,check_value){
	parent_value=parent_value || "";
	$.get("job.php",{"action":"region","region_type":region_type,"parent_value":parent_value,"check_value":check_value},LoadData);
	function LoadData(xml){
		var root=xml.documentElement;
		var items=root.getElementsByTagName("item");
		var length=items.length;
		if(length>0 && document.getElementById(objId)){
			document.getElementById(objId).innerHTML="";
			for(var i=0;i<length;i++){
				var option=document.createElement("option");
				option.value=items[i].getAttribute("id");
				if(items[i].getAttribute("selected")==1) option.selected="selected";
				option.innerHTML=items[i].getAttribute("name");
				document.getElementById(objId).appendChild(option);
			}
		}
	}
}
function LoadRegion_clear(id){
	if(document.getElementById(id)){
		document.getElementById(id).innerHTML="";
		var option=document.createElement("option");
		option.value="";
		option.innerHTML="区";
		document.getElementById(id).appendChild(option);
	}
}