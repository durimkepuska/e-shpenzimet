(function(d){typeof module==="object"&&module.exports?module.exports=d:d(Highcharts)})(function(d){function A(a,b,c){var e;!b.rgba.length||!a.rgba.length?a=b.input||"none":(a=a.rgba,b=b.rgba,e=b[3]!==1||a[3]!==1,a=(e?"rgba(":"rgb(")+Math.round(b[0]+(a[0]-b[0])*(1-c))+","+Math.round(b[1]+(a[1]-b[1])*(1-c))+","+Math.round(b[2]+(a[2]-b[2])*(1-c))+(e?","+(b[3]+(a[3]-b[3])*(1-c)):"")+")");return a}var t=function(){},q=d.getOptions(),h=d.each,l=d.extend,B=d.format,u=d.pick,r=d.wrap,m=d.Chart,p=d.seriesTypes,
v=p.pie,n=p.column,w=d.Tick,x=d.fireEvent,y=d.inArray,z=1;h(["fill","stroke"],function(a){d.Fx.prototype[a+"Setter"]=function(){this.elem.attr(a,A(d.Color(this.start),d.Color(this.end),this.pos))}});l(q.lang,{drillUpText:"\u25c1 Kthehu"});q.drilldown={activeAxisLabelStyle:{cursor:"pointer",color:"#0d233a",fontWeight:"normal",textDecoration:"normal"},activeDataLabelStyle:{cursor:"pointer",color:"#0d233a",fontWeight:"normal",textDecoration:"underline"},animation:{duration:500},drillUpButton:{position:{align:"right",
x:-10,y:10}}};d.SVGRenderer.prototype.Element.prototype.fadeIn=function(a){this.attr({opacity:0.1,visibility:"inherit"}).animate({opacity:u(this.newOpacity,1)},a||{duration:250})};m.prototype.addSeriesAsDrilldown=function(a,b){this.addSingleSeriesAsDrilldown(a,b);this.applyDrilldown()};m.prototype.addSingleSeriesAsDrilldown=function(a,b){var c=a.series,e=c.xAxis,g=c.yAxis,f;f=a.color||c.color;var i,d=[],j=[],k,o;if(!this.drilldownLevels)this.drilldownLevels=[];k=c.options._levelNumber||0;(o=this.drilldownLevels[this.drilldownLevels.length-
1])&&o.levelNumber!==k&&(o=void 0);b=l({color:f,_ddSeriesId:z++},b);i=y(a,c.points);h(c.chart.series,function(a){if(a.xAxis===e&&!a.isDrilling)a.options._ddSeriesId=a.options._ddSeriesId||z++,a.options._colorIndex=a.userOptions._colorIndex,a.options._levelNumber=a.options._levelNumber||k,o?(d=o.levelSeries,j=o.levelSeriesOptions):(d.push(a),j.push(a.options))});f={levelNumber:k,seriesOptions:c.options,levelSeriesOptions:j,levelSeries:d,shapeArgs:a.shapeArgs,bBox:a.graphic?a.graphic.getBBox():{},color:f,
lowerSeriesOptions:b,pointOptions:c.options.data[i],pointIndex:i,oldExtremes:{xMin:e&&e.userMin,xMax:e&&e.userMax,yMin:g&&g.userMin,yMax:g&&g.userMax}};this.drilldownLevels.push(f);f=f.lowerSeries=this.addSeries(b,!1);f.options._levelNumber=k+1;if(e)e.oldPos=e.pos,e.userMin=e.userMax=null,g.userMin=g.userMax=null;if(c.type===f.type)f.animate=f.animateDrilldown||t,f.options.animation=!0};m.prototype.applyDrilldown=function(){var a=this.drilldownLevels,b;if(a&&a.length>0)b=a[a.length-1].levelNumber,
h(this.drilldownLevels,function(a){a.levelNumber===b&&h(a.levelSeries,function(a){a.options&&a.options._levelNumber===b&&a.remove(!1)})});this.redraw();this.showDrillUpButton()};m.prototype.getDrilldownBackText=function(){var a=this.drilldownLevels;if(a&&a.length>0)return a=a[a.length-1],a.series=a.seriesOptions,B(this.options.lang.drillUpText,a)};m.prototype.showDrillUpButton=function(){var a=this,b=this.getDrilldownBackText(),c=a.options.drilldown.drillUpButton,e,g;this.drillUpButton?this.drillUpButton.attr({text:b}).align():
(g=(e=c.theme)&&e.states,this.drillUpButton=this.renderer.button(b,null,null,function(){a.drillUp()},e,g&&g.hover,g&&g.select).attr({align:c.position.align,zIndex:9}).add().align(c.position,!1,c.relativeTo||"plotBox"))};m.prototype.drillUp=function(){for(var a=this,b=a.drilldownLevels,c=b[b.length-1].levelNumber,e=b.length,g=a.series,f,i,d,j,k=function(b){var c;h(g,function(a){a.options._ddSeriesId===b._ddSeriesId&&(c=a)});c=c||a.addSeries(b,!1);if(c.type===d.type&&c.animateDrillupTo)c.animate=c.animateDrillupTo;
b===i.seriesOptions&&(j=c)};e--;)if(i=b[e],i.levelNumber===c){b.pop();d=i.lowerSeries;if(!d.chart)for(f=g.length;f--;)if(g[f].options.id===i.lowerSeriesOptions.id&&g[f].options._levelNumber===c+1){d=g[f];break}d.xData=[];h(i.levelSeriesOptions,k);x(a,"drillup",{seriesOptions:i.seriesOptions});if(j.type===d.type)j.drilldownLevel=i,j.options.animation=a.options.drilldown.animation,d.animateDrillupFrom&&d.chart&&d.animateDrillupFrom(i);j.options._levelNumber=c;d.remove(!1);if(j.xAxis)f=i.oldExtremes,
j.xAxis.setExtremes(f.xMin,f.xMax,!1),j.yAxis.setExtremes(f.yMin,f.yMax,!1)}this.redraw();this.drilldownLevels.length===0?this.drillUpButton=this.drillUpButton.destroy():this.drillUpButton.attr({text:this.getDrilldownBackText()}).align();this.ddDupes.length=[]};n.prototype.supportsDrilldown=!0;n.prototype.animateDrillupTo=function(a){if(!a){var b=this,c=b.drilldownLevel;h(this.points,function(a){a.graphic&&a.graphic.hide();a.dataLabel&&a.dataLabel.hide();a.connector&&a.connector.hide()});setTimeout(function(){b.points&&
h(b.points,function(a,b){var f=b===(c&&c.pointIndex)?"show":"fadeIn",d=f==="show"?!0:void 0;if(a.graphic)a.graphic[f](d);if(a.dataLabel)a.dataLabel[f](d);if(a.connector)a.connector[f](d)})},Math.max(this.chart.options.drilldown.animation.duration-50,0));this.animate=t}};n.prototype.animateDrilldown=function(a){var b=this,c=this.chart.drilldownLevels,e,d=this.chart.options.drilldown.animation,f=this.xAxis;if(!a)h(c,function(a){if(b.options._ddSeriesId===a.lowerSeriesOptions._ddSeriesId)e=a.shapeArgs,
e.fill=a.color}),e.x+=u(f.oldPos,f.pos)-f.pos,h(this.points,function(a){a.graphic&&a.graphic.attr(e).animate(l(a.shapeArgs,{fill:a.color}),d);a.dataLabel&&a.dataLabel.fadeIn(d)}),this.animate=null};n.prototype.animateDrillupFrom=function(a){var b=this.chart.options.drilldown.animation,c=this.group,e=this;h(e.trackerGroups,function(a){if(e[a])e[a].on("mouseover")});delete this.group;h(this.points,function(e){var f=e.graphic,i=function(){f.destroy();c&&(c=c.destroy())};f&&(delete e.graphic,b?f.animate(l(a.shapeArgs,
{fill:a.color}),d.merge(b,{complete:i})):(f.attr(a.shapeArgs),i()))})};v&&l(v.prototype,{supportsDrilldown:!0,animateDrillupTo:n.prototype.animateDrillupTo,animateDrillupFrom:n.prototype.animateDrillupFrom,animateDrilldown:function(a){var b=this.chart.drilldownLevels[this.chart.drilldownLevels.length-1],c=this.chart.options.drilldown.animation,e=b.shapeArgs,g=e.start,f=(e.end-g)/this.points.length;if(!a)h(this.points,function(a,h){a.graphic.attr(d.merge(e,{start:g+h*f,end:g+(h+1)*f,fill:b.color}))[c?
"animate":"attr"](l(a.shapeArgs,{fill:a.color}),c)}),this.animate=null}});d.Point.prototype.doDrilldown=function(a,b){var c=this.series.chart,e=c.options.drilldown,d=(e.series||[]).length,f;if(!c.ddDupes)c.ddDupes=[];for(;d--&&!f;)e.series[d].id===this.drilldown&&y(this.drilldown,c.ddDupes)===-1&&(f=e.series[d],c.ddDupes.push(this.drilldown));x(c,"drilldown",{point:this,seriesOptions:f,category:b,points:b!==void 0&&this.series.xAxis.ddPoints[b].slice(0)});f&&(a?c.addSingleSeriesAsDrilldown(this,f):
c.addSeriesAsDrilldown(this,f))};d.Axis.prototype.drilldownCategory=function(a){var b,c,d=this.ddPoints[a];for(b in d)(c=d[b])&&c.series&&c.series.visible&&c.doDrilldown&&c.doDrilldown(!0,a);this.chart.applyDrilldown()};d.Axis.prototype.getDDPoints=function(a,b){var c=this.ddPoints;if(!c)this.ddPoints=c={};c[a]||(c[a]=[]);if(c[a].levelNumber!==b)c[a].length=0;return c[a]};w.prototype.drillable=function(){var a=this.pos,b=this.label,c=this.axis,e=c.ddPoints&&c.ddPoints[a];if(b&&e&&e.length){if(!b.basicStyles)b.basicStyles=
d.merge(b.styles);b.addClass("highcharts-drilldown-axis-label").css(c.chart.options.drilldown.activeAxisLabelStyle).on("click",function(){c.drilldownCategory(a)})}else if(b&&b.basicStyles)b.styles={},b.css(b.basicStyles),b.on("click",null)};r(w.prototype,"addLabel",function(a){a.call(this);this.drillable()});r(d.Point.prototype,"init",function(a,b,c,e){var g=a.call(this,b,c,e),a=(c=b.xAxis)&&c.ticks[e],c=c&&c.getDDPoints(e,b.options._levelNumber);if(g.drilldown&&(d.addEvent(g,"click",function(){b.xAxis&&
b.chart.options.drilldown.allowPointDrilldown===!1?b.xAxis.drilldownCategory(e):g.doDrilldown()}),c))c.push(g),c.levelNumber=b.options._levelNumber;a&&a.drillable();return g});r(d.Series.prototype,"drawDataLabels",function(a){var b=this.chart.options.drilldown.activeDataLabelStyle;a.call(this);h(this.points,function(a){a.drilldown&&a.dataLabel&&a.dataLabel.attr({"class":"highcharts-drilldown-data-label"}).css(b)})});var s,q=function(a){a.call(this);h(this.points,function(a){a.drilldown&&a.graphic&&
a.graphic.attr({"class":"highcharts-drilldown-point"}).css({cursor:"pointer"})})};for(s in p)p[s].prototype.supportsDrilldown&&r(p[s].prototype,"drawTracker",q)});
