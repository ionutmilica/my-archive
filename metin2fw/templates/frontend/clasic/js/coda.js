$(function(){});var sliderCount=1;$.fn.codaSlider=function(a){a=$.extend({autoHeight:true,autoHeightEaseDuration:1000,autoHeightEaseFunction:"easeInOutExpo",autoSlide:true,autoSlideInterval:7000,autoSlideStopWhenClicked:true,crossLinking:true,dynamicArrows:false,dynamicArrowLeftText:"&#171; left",dynamicArrowRightText:"right &#187;",dynamicTabs:true,dynamicTabsAlign:"right",dynamicTabsPosition:"bottom",externalTriggerSelector:"a.xtrig",firstPanelToLoad:1,panelTitleSelector:"h2.title",slideEaseDuration:1000,slideEaseFunction:"easeInOutExpo"},a);return this.each(function(){var e=$(this);if(a.dynamicArrows){e.parent().addClass("arrows");e.before('<div class="coda-nav-left" id="coda-nav-left-'+sliderCount+'"><a href="#">'+a.dynamicArrowLeftText+"</a></div>");e.after('<div class="coda-nav-right" id="coda-nav-right-'+sliderCount+'"><a href="#">'+a.dynamicArrowRightText+"</a></div>")}var b=e.find(".panel").width();var j=e.find(".panel").size();var k=b*j;var f=0;$(".panel",e).wrapAll('<div class="panel-container"></div>');$(".panel-container",e).css({width:k});if(a.crossLinking&&location.hash&&parseInt(location.hash.slice(1))<=j){var c=parseInt(location.hash.slice(1));var g=-(b*(c-1));$(".panel-container",e).css({marginLeft:g})}else{if(a.firstPanelToLoad!=1&&a.firstPanelToLoad<=j){var c=a.firstPanelToLoad;var g=-(b*(c-1));$(".panel-container",e).css({marginLeft:g})}else{var c=1}}if(a.dynamicTabs){var i='<div class="coda-nav" id="coda-nav-'+sliderCount+'"><ul></ul></div>';switch(a.dynamicTabsPosition){case"bottom":e.parent().append(i);break;default:e.parent().prepend(i);break}ul=$("#coda-nav-"+sliderCount+" ul");$(".panel",e).each(function(l){ul.append('<li class="tab'+(l+1)+'"><a href="#'+(l+1)+'">'+$(this).find(a.panelTitleSelector).text()+"</a></li>")});navContainerWidth=e.width()+e.siblings(".coda-nav-left").width()+e.siblings(".coda-nav-right").width();ul.parent().css({width:navContainerWidth});switch(a.dynamicTabsAlign){case"center":ul.css({width:($("li",ul).width()+2)*j});break;case"right":ul.css({"float":"right"});break}}$("#coda-nav-"+sliderCount+" a").each(function(l){$(this).bind("click",function(){f++;$(this).addClass("current").parents("ul").find("a").not($(this)).removeClass("current");g=-(b*l);h(l);c=l+1;$(".panel-container",e).animate({marginLeft:g},a.slideEaseDuration,a.slideEaseFunction);if(!a.crossLinking){return false}})});$(a.externalTriggerSelector).each(function(){if(sliderCount==parseInt($(this).attr("rel").slice(12))){$(this).bind("click",function(){f++;targetPanel=parseInt($(this).attr("href").slice(1));g=-(b*(targetPanel-1));h(targetPanel-1);c=targetPanel;e.siblings(".coda-nav").find("a").removeClass("current").parents("ul").find("li:eq("+(targetPanel-1)+") a").addClass("current");$(".panel-container",e).animate({marginLeft:g},a.slideEaseDuration,a.slideEaseFunction);if(!a.crossLinking){return false}})}});if(a.crossLinking&&location.hash&&parseInt(location.hash.slice(1))<=j){$("#coda-nav-"+sliderCount+" a:eq("+(location.hash.slice(1)-1)+")").addClass("current")}else{if(a.firstPanelToLoad!=1&&a.firstPanelToLoad<=j){$("#coda-nav-"+sliderCount+" a:eq("+(a.firstPanelToLoad-1)+")").addClass("current")}else{$("#coda-nav-"+sliderCount+" a:eq(0)").addClass("current")}}if(a.autoHeight){panelHeight=$(".panel:eq("+(c-1)+")",e).height();e.css({height:panelHeight})}if(a.autoSlide){e.ready(function(){setTimeout(d,a.autoSlideInterval)})}function h(l){if(a.autoHeight){panelHeight=$(".panel:eq("+l+")",e).height();e.animate({height:panelHeight},a.autoHeightEaseDuration,a.autoHeightEaseFunction)}}function d(){if(f==0||!a.autoSlideStopWhenClicked){if(c==j){var l=0;c=1}else{var l=-(b*c);c+=1}h(c-1);e.siblings(".coda-nav").find("a").removeClass("current").parents("ul").find("li:eq("+(c-1)+") a").addClass("current");$(".panel-container",e).animate({marginLeft:l},a.slideEaseDuration,a.slideEaseFunction);setTimeout(d,a.autoSlideInterval)}}$(".panel",e).show().end().find("p.loading").remove();e.removeClass("preload");sliderCount++})};