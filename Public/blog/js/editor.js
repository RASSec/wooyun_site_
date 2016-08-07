/**
	蓝天白云Editor 1.0
	@param  objId:编辑textarea id, toolsObjId:工具条id, toolsArr:工具选项(["B","I","U","code","IMG"])
*/
function 蓝天白云Editor(objId,toolsObjId,toolsArr){
	var editor_obj=document.getElementById(objId);
	var editor_toolsObj=document.getElementById(toolsObjId);
	var editor_uploadedId=objId+"_iu";
	//initialize toolsbar
	editor_toolsObj.innerHTML="";
	for(var i=0;i<toolsArr.length;i++){
		var aLink=document.createElement("a");
		aLink.href="javascript:void(0)";
		var mark=toolsArr[i].toLowerCase();
		switch(mark){
			case 'code':
				aLink.innerHTML="<u>&lt;code&gt;</u>";
				aLink.onclick=(function(mark){ return function(){InsertMark(mark);} })(mark);
				break;
			case 'img':
				var imgUlink=document.createElement("u");
				
				imgUlink.onclick=function(){ 
					imgContainer.style.display="block";
					document.getElementById(editor_uploadedId).value="";
				};
				aLink.appendChild(imgUlink);
				//img container
				var imgContainer=document.createElement("div");
				imgContainer.className="imgContainer";
				aLink.appendChild(imgContainer);
				//uploaded image
				var imgIframe=document.createElement("iframe");
				imgIframe.className="imgIframe";
				imgIframe.src="/editor/image.php?uploadedId="+editor_uploadedId;
				imgIframe.marginWidth="0";
				imgIframe.marginHeight="0";
				imgIframe.frameBorder="0";
				imgIframe.scrolling="no";
				imgContainer.appendChild(imgIframe);
				//network image
				var imgNetwork=document.createElement("div");
				imgNetwork.appendChild(document.createTextNode("地址："));
				var imgNetInput=document.createElement("input");
				imgNetInput.id=editor_uploadedId;
				imgNetInput.style.width="267px";
				imgNetwork.appendChild(imgNetInput);
				imgContainer.appendChild(imgNetwork);
				//image button
				var imgButton=document.createElement("div");
				imgButton.className="imgButton";
				imgContainer.appendChild(imgButton);
				var imgBtnSure=document.createElement("input");
				imgBtnSure.type="button";
				imgBtnSure.value="确定";
				imgBtnSure.onclick=function(){
					if(imgNetInput.value==""){
						alert("请上传图片或填写图片地址");
					}else{
						InsertAtCursor(editor_obj,'<img src="'+imgNetInput.value+'" />');
						imgContainer.style.display="none";
					}
				}
				imgButton.appendChild(imgBtnSure);
				var imgBtnCancel=document.createElement("input");
				imgBtnCancel.type="button";
				imgBtnCancel.value="取消";
				imgButton.appendChild(imgBtnCancel);
				imgBtnCancel.onclick=function(){ imgContainer.style.display="none"; };
				break;
			default:
				aLink.innerHTML="<"+mark+">"+toolsArr[i]+"</"+mark+">";
				aLink.onclick=(function(mark){ return function(){InsertMark(mark);} })(mark);
				break;
		}
		editor_toolsObj.appendChild(aLink);
	}
	/* functions */
	function InsertMark(mark){
		InsertAtCursor(editor_obj,"<"+mark+">","</"+mark+">");
	}
	function InsertAtCursor(obj,value,endValue){
		if(document.selection){
			obj.focus();
			var sel=document.selection.createRange();
			sel.text=endValue ? value+sel.text+endValue : sel.text+value;
			sel.select();
		}else if(obj.selectionStart||obj.selectionStart=="0"){
			var startPos=obj.selectionStart;
			var endPos=obj.selectionEnd;
			var restoreTop=obj.scrollTop;
			var sel=obj.value.substring(startPos,endPos);
			obj.value=obj.value.substring(0,startPos)+(endValue ? value+sel+endValue : sel+value)+obj.value.substring(endPos,obj.value.length);
			if(restoreTop>0) obj.scrollTop=restoreTop;
			obj.focus();
			obj.selectionStart=startPos+value.length;
			obj.selectionEnd=startPos+value.length;
		}else{
			obj.value+=value;
			obj.focus();
		}
	}
}