(()=>{var e=[],o=(document.getElementById("controls"),new bootstrap.Modal(document.getElementById("propsModal")));function a(e){this.e=e,this.info={name:void 0,description:void 0}}function t(e){var o={name:document.getElementById("modal-name"),description:document.getElementById("modal-description")};if(e)for(var a in o)o[a]=o[a].value;return o}function n(e){o.tag=e;var a=t(!1);a.name.value=e.info.name,a.description.value=e.info.description,o.show()}function r(o,t){var r=new a;switch(r.info.name=t.name,r.info.description=t.description,t.overlay.type){case"circle":break;case"marker":r.e=new google.maps.Marker({position:t.overlay.geometry,map:o,title:t.name});break;case"rectangle":r.e=new google.maps.Rectangle({map:o,bounds:t.overlay.geometry});break;case"polyline":r.e=new google.maps.Polyline({path:t.overlay.geometry.Nb,map:o});break;case"polygon":r.e=new google.maps.Polygon({paths:t.overlay.geometry.Nb[0].Nb,map:o})}r.e.type=t.overlay.type,google.maps.event.addListener(r.e,"click",(function(){return n(r)})),e.push(r)}a.prototype.toString=function(){var e={type:this.e.type},o=this.e.overlay||this.e;switch(this.e.type){default:throw new Error("unknown overlay type:",this.e.type);case"circle":e.radius=o.getRadius(),e.geometry=o.getCenter();break;case"marker":e.geometry=o.getPosition();break;case"rectangle":e.geometry=o.getBounds();break;case"polyline":e.geometry=o.getPath();break;case"polygon":e.geometry=o.getPaths()}var a={name:this.info.name,description:this.info.description,overlay:e};return JSON.stringify(a)},window.SaveControl=function(){var e=o.tag;if(e){var a=t(!0);e.info={name:a.name,description:a.description},(e.e.overlay||e.e).addListener("click",(function(){return n(e)})),o.tag=null,o.hide()}},window.DeleteControl=function(){var a=o.tag;if(a){var t=e.indexOf(a);if(!(t<0))(a.e.overlay||a.e).setMap(null),e.splice(t,1),o.tag=null,o.hide()}},window.initMap=function(){var t=new google.maps.Map(document.getElementById("map"),{center:{lat:51.149171,lng:-114.998456},zoom:15});t.addListener("click",(function(e){var o=e.latLng;console.log(o.lat(),o.lng())})),$.ajax({dataType:"json",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},method:"POST",success:function(e,o,a){for(var n=0;n<e.length;n++)r(t,e[n])},error:function(e,o,a){console.log(a)},processData:!1,url:"/api/map"});var n=new google.maps.drawing.DrawingManager({drawingControl:!0,drawingControlOptions:{position:google.maps.ControlPosition.TOP_CENTER,drawingModes:[google.maps.drawing.OverlayType.MARKER,google.maps.drawing.OverlayType.POLYGON,google.maps.drawing.OverlayType.POLYLINE,google.maps.drawing.OverlayType.RECTANGLE]},markerOptions:{icon:"https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png"},circleOptions:{fillColor:"#ffff00",fillOpacity:1,strokeWeight:5,clickable:!1,editable:!0,zIndex:1}});google.maps.event.addListener(n,"overlaycomplete",(function(t){n.setDrawingMode(null);var r=new a(t);o.tag=r,e.push(r),o.show()})),n.setMap(t)},window.SaveOverlays=function(){$.ajax({data:e.toString(),dataType:"json",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},method:"POST",success:function(e,o,a){$(".toast .toast-body").text("Changes have been saved."),$(".toast").toast("show")},error:function(e,o,a){console.log(a)},processData:!1,url:"/admin/map/save"})}})();