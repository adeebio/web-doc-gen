/*
|--------------------------------------------------
| BORDER RESIZING
|--------------------------------------------------
*/

border = {
	
	x: 0,
	
	miniumMenuWidth: 10,
	
	maxiumMenuWidth: 300,
	
	down: function () {
		
		// Set mouse x coordinate.
		border.x = event.clientX;
		
		// Add onmousemove event listener.
		document.onmousemove = border.move;
		
		// Add onmouseup event listener.
		document.onmouseup = border.up;
		
		// Set cursor.
		document.getElementById("menu").style.cursor = "col-resize";
		document.getElementById("content").style.cursor = "col-resize";
		
	},
	
	move: function () {
		
		// Update mouse x coordinate.
		border.x = event.clientX;
		
		// Update CSS.
		if ((border.x>border.miniumMenuWidth)&&(border.x<border.maxiumMenuWidth)) {
			
			temp1 = (border.x - 21).toString()+"px";
			temp2 = (border.x - 1).toString()+"px";
			temp3 = (border.x + 2).toString()+"px";
			
			document.getElementById("menu").style.width = temp1;
			document.getElementById("border").style.left = temp2;
			document.getElementById("content").style.left = temp3;
		
		};
		
	},
	
	up: function () {
		
		// Remove onmousemove event listener.
		document.onmousemove = function () {};
		
		// Remove onmouseup event listener.
		document.onmouseup = function () {};
		
		// Remove cursor.
		document.getElementById("menu").style.cursor = "default";
		document.getElementById("content").style.cursor = "default";
		
	}
	
};

/*
|--------------------------------------------------
| CONTENT RESIZING
|--------------------------------------------------
*/

content = {
	
	loadedDom: false,
	
	load: function (variables,domRef,itemType) {
		
		// Delare a xmlHTTP Object.
		
		var xmlhttp = content.getXMLHTTPObject();
		
		// Declare path.
		
		var path = "index.php?" + variables;
		
		// Response function when state of xmlhttp is complete (4).
		
		function stateChanged () {
			
			if (xmlhttp.readyState==4) {
				
				if (itemType == "file") {
					
					// Remove the old highlighted menu item.
					
					content.loadedDom.className = "item_menu_header";
					
					// Update domRef storage.
					
					content.loadedDom = domRef;
					
					// Set the new highlighted menu item.
					
					content.loadedDom.className = "item_menu_header_selected";
					
				};
				
				if (itemType == "folder") {
					
					// Remove the old highlighted menu item.
					
					content.loadedDom.className = "item_menu_header";
					
					// Update domRef storage.
					
					content.loadedDom = domRef.parentNode;
					
					// Set the new highlighted menu item.
					
					content.loadedDom.className = "item_menu_header_selected";
					
				};
				
				// Load content into body.
				
				document.getElementById("body").innerHTML = xmlhttp.responseText;
				
			};
			
		};
		
		// Carry out AJAX request.
		
		xmlhttp.onreadystatechange=stateChanged;
		
		xmlhttp.open("GET",path,true);
		
		xmlhttp.send(null);
		
		return;
		
	},
	
	getXMLHTTPObject: function () {
	
		if(window.XMLHttpRequest){return new XMLHttpRequest();};// Code for IE7+, Firefox, Chrome, Opera, Safari
		if(window.ActiveXObject){return new ActiveXObject("Microsoft.XMLHTTP");}// Code for IE6, IE5
		else{alert("Your browser does not support XMLHTTP! Please update!");return;};
		
	},
	
	initial: function () {
		
		// Load initial content.
		content.load('initialContent=default',null,null);
		
		// Set domRef storage.
		content.loadedDom = document.getElementById("initiallySelected");
		
		// Set initial highlighted menu item.
		content.loadedDom.className = "item_menu_header_selected";
		
	}
		
};

/*
|--------------------------------------------------
| FOLDER STATUS SCRIPT
|--------------------------------------------------
*/

folder = {
	
	statusClicked: function (domRef) {
		
		if (domRef.parentNode.parentNode.childNodes[3].style.display == "none") {
			
			domRef.parentNode.childNodes[1].innerHTML = "-";
			domRef.parentNode.parentNode.childNodes[3].style.display = "block";
			
		} else {
			
			domRef.parentNode.childNodes[1].innerHTML = "+";
			domRef.parentNode.parentNode.childNodes[3].style.display = "none";
			
		};
		
	}
		
}