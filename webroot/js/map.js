var projSpherique = new OpenLayers.Projection("EPSG:4326");

function test() {
  var latitude = document.getElementsByTagName("dd")[4];
  var longitude = document.getElementsByTagName("dd")[5];
  var x = document.getElementById("demo");  
  x.innerHTML=longitude.textContent;
}

function initCarte1(){
  var latitude = document.getElementsByTagName("dd")[4].textContent;
  var longitude = document.getElementsByTagName("dd")[5].textContent;

  var map = new OpenLayers.Map("map_detail");

  map.addLayer(new OpenLayers.Layer.OSM());
  var projCarte = map.getProjectionObject();
  var coord = new OpenLayers.LonLat(longitude,latitude); // coordonnées en longitude/latitude
  coord.transform(projSpherique,projCarte);
  map.setCenter(coord,7);


  markers = new OpenLayers.Layer.Markers("Repères");
  map.addLayer(markers);

  var size = new OpenLayers.Size(50,40);
  var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
  var icon = new OpenLayers.Icon('/projet/img/map-marker-small-hi.png', size, offset);


  var marker_com = new OpenLayers.Marker(coord, icon);
  markers.addMarker(marker_com);

}

 function initCarte2(){
    var map = new OpenLayers.Map("carte2");
    map.addLayer(new OpenLayers.Layer.OSM());
    var projCarte = map.getProjectionObject();
    var coord = new OpenLayers.LonLat(2.87962,42.69608); // coordonnées en longitude/latitude
    coord.transform(projSpherique,projCarte);
    map.setCenter(coord,16);
 }

 function initCarte3(){
    var map = new OpenLayers.Map("carte3");
    map.addLayer(new OpenLayers.Layer.OSM());
    var projCarte = map.getProjectionObject();
    var coord = new OpenLayers.LonLat(2.87962,42.69608); // coordonnées en longitude/latitude
    coord.transform(projSpherique,projCarte);
    map.setCenter(coord,16);
    calqueMarkers = new OpenLayers.Layer.Markers("Repères");
    map.addLayer(calqueMarkers);
    var garePerpignan=new OpenLayers.Marker(coord);
    calqueMarkers.addMarker(garePerpignan);
 }
 
 function initCarte4(){
    var map = new OpenLayers.Map("carte4");
    map.addLayer(new OpenLayers.Layer.OSM());
    var projCarte = map.getProjectionObject();
    var coordBU = new OpenLayers.LonLat(3.14159,50.6092).transform(projSpherique,projCarte);
    map.setCenter(coordBU,15);
   var p1Geo = new OpenLayers.Geometry.Point(3.14159,50.0);
   var p2Geo = new OpenLayers.Geometry.Point(3.14159,51.0);
   var p1Carte = p1Geo.transform(projSpherique,projCarte);
   var p2Carte = p2Geo.transform(projSpherique,projCarte);
   var meridienPI = new OpenLayers.Geometry.LineString([p1Carte,p2Carte]);
   var featureLine = new OpenLayers.Feature.Vector(
         meridienPI,
         {name:"PI"},
         {strokeColor:"blue",strokeWidth:"2"}
        );
   var calqueDessins = new OpenLayers.Layer.Vector("Dessins");
   calqueDessins.addFeatures([featureLine]);
   map.addLayer(calqueDessins);
 }
 
function initCarte4bis(){
    var map = new OpenLayers.Map("carte4bis");
    map.addLayer(new OpenLayers.Layer.OSM());
    var projCarte = map.getProjectionObject();
    var coordBU = new OpenLayers.LonLat(3.14159,50.6092).transform(projSpherique,projCarte);
    map.setCenter(coordBU,15);
   var p1Geo = new OpenLayers.Geometry.Point(3.14159,50.0);
   var p2Geo = new OpenLayers.Geometry.Point(3.14159,51.0);
   var p1Carte = p1Geo.transform(projSpherique,projCarte);
   var p2Carte = p2Geo.transform(projSpherique,projCarte);
   var meridienPI = new OpenLayers.Geometry.LineString([p1Carte,p2Carte]);
   var featureLine = new OpenLayers.Feature.Vector(
         meridienPI,
         {name:"PI"},
         {strokeColor:"blue",strokeWidth:"2"}
        );
    var pointBU = new OpenLayers.Geometry.Point(coordBU.lon,coordBU.lat); // coord déjà transformées
    var featurePoint = new OpenLayers.Feature.Vector(
         pointBU,
         null,
         {label:"BU",fontColor:"green" }
        );
   var calqueDessins = new OpenLayers.Layer.Vector("Dessins");
   calqueDessins.addFeatures([featureLine,featurePoint]);
   map.addLayer(calqueDessins);
   console.log("fin4bis");
 }
 
 function initCarte5(){
    var map = new OpenLayers.Map("carte5");
    map.addLayer(new OpenLayers.Layer.OSM());
    var projCarte = map.getProjectionObject();
    calqueMarkers = new OpenLayers.Layer.Markers("Repères");
    map.addLayer(calqueMarkers);
    var coordBU= new OpenLayers.LonLat(3.14159,50.6092).transform(projSpherique,projCarte);
    var coordM5= new OpenLayers.LonLat(3.1365,50.6095).transform(projSpherique,projCarte);
    var M5=new OpenLayers.Marker(coordM5);
    var BU=new OpenLayers.Marker(coordBU);
    calqueMarkers.addMarker(M5);
    calqueMarkers.addMarker(BU);
    map.setCenter(coordBU,15);
   var p1Geo = new OpenLayers.Geometry.Point(3.14159,50.0);
   var p2Geo = new OpenLayers.Geometry.Point(3.14159,51.0);
   var p1Carte = p1Geo.transform(projSpherique,projCarte);
   var p2Carte = p2Geo.transform(projSpherique,projCarte);
   var meridienPI = new OpenLayers.Geometry.LineString([p1Carte,p2Carte]);
   var featureLine = new OpenLayers.Feature.Vector(meridienPI,null,{strokeColor:"blue",strokeWidth:"2"});
   var calqueDessins = new OpenLayers.Layer.Vector("Dessins");
   calqueDessins.addFeatures([featureLine]);
   map.addLayer(calqueDessins);
   map.addControl(new OpenLayers.Control.LayerSwitcher({'ascending':false}));
 }

 window.addEventListener("load",initCarte1,false);
 /*window.addEventListener("load",test,false);
 /*window.addEventListener("load",initCarte2,false);
 window.addEventListener("load",initCarte3,false);
 window.addEventListener("load",initCarte4,false);
 window.addEventListener("load",initCarte4bis,false);
 window.addEventListener("load",initCarte5,false);*/