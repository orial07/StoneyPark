(()=>{function e(e){this.e=e,this.info={name:void 0,description:void 0}}e.prototype.toString=function(){var e={type:this.e.type},o=this.e.overlay||this.e;switch(this.e.type){default:throw new Error("unknown overlay type:",this.e.type);case"circle":e.radius=o.getRadius(),e.geometry=o.getCenter();break;case"marker":e.geometry=o.getPosition();break;case"rectangle":e.geometry=o.getBounds();break;case"polyline":e.geometry=o.getPath();break;case"polygon":e.geometry=o.getPaths()}var t={name:this.info.name,description:this.info.description,overlay:e};return JSON.stringify(t)};var o=new bootstrap.Modal(document.getElementById("maps-modal"));function t(t,n){var a=new e;switch(a.info.name=n.name,a.info.description=n.description,n.overlay.type){case"circle":break;case"marker":a.e=new google.maps.Marker({map:t,position:n.overlay.geometry,title:n.name});break;case"rectangle":a.e=new google.maps.Rectangle({map:t,bounds:n.overlay.geometry});break;case"polyline":a.e=new google.maps.Polyline({map:t,path:n.overlay.geometry.Nb});break;case"polygon":a.e=new google.maps.Polygon({map:t,paths:n.overlay.geometry.Nb[0].Nb})}var r=new google.maps.InfoWindow({content:"<div>\n    <p><strong>".concat(n.name,"</strong></p>\n    <p>").concat(n.description,"</p>\n</div>")});a.e.addListener("click",(function(){r.open(t,a.e),function(e){$("#modal-name").text(e.info.name),$("#modal-description").text(e.info.description),o.show()}(a)}))}window.initMap=function(){var e=new google.maps.Map(document.getElementById("map"),{center:{lat:51.05563894221939,lng:-114.07027244567871},zoom:15});$.ajax({dataType:"json",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},method:"POST",success:function(o,n,a){for(var r=0;r<o.length;r++)t(e,o[r])},error:function(e,o,t){console.log(t)},processData:!1,url:"/map/load"}),window.MAP=e}})();