(()=>{var e=document.reserve_form,n=document.getElementById("total"),t=1;function a(){var e=0;document.getElementById("day_count").innerHTML="This reservation will be for <strong>".concat(t," night").concat(t>1?"s":"","</strong>");var a=function(){for(var e=document.getElementsByName("camping_type"),n=0;n<e.length;n++)if(e[n].checked)return n}();switch(a){case 0:case 1:e=39;break;case 2:e=69}e*=t,1==a&&(e+=30),n.innerText="$"+e}$(document).ready((function(){a();var n=new Date;$('input[name="dates"]').daterangepicker({minDate:n,startDate:n,endDate:new Date(n.getTime()+864e5)},(function(e,n,r){!function(e,n){var r=(n-e)/1e3/60/60/24;t=Math.round(r),a()}(e,n)})),e.addEventListener("change",(function(e){"campers"==e.target.name&&function(e){var n=Math.max(1,Math.min(6,e.value)),t=document.getElementById("campers");t.innerHTML="";for(var a=0;a<n-1;a++)t.innerHTML+='<div class="input-group mb-3">\n                <div class="input-group-prepend">\n                    <span class="input-group-text" id="">Name</span>\n                </div>\n                <input type="text" class="form-control" placeholder="First Name" name="camper'.concat(a,'_first_name" autofocus required />\n                <input type="text" class="form-control" placeholder="Last Name" name="camper').concat(a,'_last_name" required />\n            </div>')}(e.target),a()}))}))})();