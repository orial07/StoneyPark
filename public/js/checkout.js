(()=>{var e=function(){var e=document.querySelector("#cg-campsite-refresh");e.innerHTML='<div class="spinner-border" role="status">\n  <span class="visually-hidden">Loading...</span>\n</div>';var t=$('input[name="dates"]').data("daterangepicker"),a=t.startDate.format(r),n=t.endDate.format(r);!function(){for(var e=document.querySelectorAll("#cg-campsite-list > div"),t=0;t<e.length;t++){var a=e[t],n=document.querySelector("#".concat(a.id,"-status"));n.innerHTML="Checking...",n.classList.remove("bg-danger","bg-success","bg-warning","text-dark")}}(),Stoney.GetCampgroundsStatus("".concat(a," - ").concat(n),(function(t,a,n){for(var r=document.querySelectorAll("#cg-campsite-list > div"),c=0;c<r.length;c++){for(var s=r[c],o=document.querySelector("#".concat(s.id,"-status")),i=!0,d=0;d<t.length;d++){var m=t[d];if(s.id==m.campground_id){if("paid"==m.status)o.classList.add("bg-danger"),o.innerHTML="Reserved";else if("pending"==m.status){if(moment.duration(moment().diff(moment(m.updated_at))).asMinutes()>=5)break;o.classList.add("bg-warning","text-dark"),o.innerHTML="Pending"}i=!1;break}}o.classList.add("bg-success"),i&&(o.innerHTML="Available")}e.innerHTML="Refresh"}))},t=function(t,a){t=t.startOf("day"),a=a.startOf("day"),nights=moment.duration(a.diff(t)).asDays(),nights<1?$("#nights").html('<span class="text-danger">The reservation must be at least 1 night long.</span>'):(n(),e())},a=function(){var e=document.querySelector("#campers-container"),t=document.querySelector("#campers-count").value;e.innerHTML="";for(var a=0;a<t-1;a++)e.innerHTML+='<div class="row">    <div class="col">        <div class="mb-3">            <label class="form-label w-100" for="camper-name-first-'.concat(a,'">First Name</label>            <input class="form-control" id="camper-name-first-').concat(a,'" name="camper-name-first-').concat(a,'" type="text" autocomplete="on" required="true" placeholder="First Name">        </div>    </div>    <div class="col">        <div class="mb-3">            <label class="form-label w-100" for="camper-name-last-').concat(a,'">Last Name</label>            <input class="form-control" id="camper-name-last-').concat(a,'" name="camper-name-last-').concat(a,'" type="text" autocomplete="on" required="true" placeholder="Last Name">        </div>    </div></div>')},n=function(){$("#nights").html('This reservation will be for <span class="fw-bold">'.concat(nights," night").concat(1==nights?"":"s","</span>"));var e=document.querySelector("input[name=camp-type]:checked").value,t=Object.keys(Stoney.Camps),a=Stoney.Camps[t[e]],n=a.price*nights;document.querySelector("#campers-count").setAttribute("max",a.campers),$("#invoice-camp-type").text(a.name),$("#invoice-camp-price").text(a.price2.asMoney()),$("#invoice-nights-qty").text(nights),$("#invoice-nights-price").text(n.asMoney()),n+=a.price2,$("#invoice-tax-gst").text((.05*n).asMoney()),$("#invoice-total").text((n*=1.05).asMoney());for(var r=0;r<t.length;r++){var c=Stoney.Camps[t[r]],s=c.price*nights+c.price2;$("#camp-type-price-".concat(r)).text(s.asMoney())}var o=$('input[name="dates"]').data("daterangepicker"),i=o.startDate.format("LL"),d=o.endDate.format("LL");$("#date-in").text(i),$("#date-out").text(d)};Stoney.OnCampgroundsLoaded=function(){var e=$('input[name="dates"]').data("daterangepicker");t(e.startDate,e.endDate)};var r="MM/DD/YYYY";Number.prototype.asMoney=function(){return"$ ".concat(this.toFixed(2))},jQuery((function(){var c=moment().set({hour:0,minute:0,second:0,millisecond:0}),s=moment(c).add(1,"day");$('input[name="dates"]').daterangepicker({startDate:c.format(r),endDate:s.format(r),minDate:c.format(r)},(function(e,a,n){t(e,a)})),a(),document.querySelector("#campers-count").onchange=function(e){return a()},document.querySelector("#reserve-form").onchange=function(e){return n()},document.querySelector("#cg-campsite-refresh").onclick=function(){return e()}}))})();