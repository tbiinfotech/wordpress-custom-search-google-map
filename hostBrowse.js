jQuery(document).ready( function() {

   jQuery(".Browse").click( function(e) {
      e.preventDefault();
      //alert('clicked');
      jQuery.ajax({
         type : "POST",
         dataType : "html",
         url : myAjax.ajaxurl,
         data : {action: "my_browse_script"},
         success: function(data) {
            if(data!=""){
              var result = jQuery.parseJSON(data);
              
              //console.log(result.hosts);
              //console.log(result);
             jQuery(".host-result").html(result.hosts);
             jQuery(".acf-map").html(result.mapMarker);
             jQuery(".header-search-count h1 span").text('('+result.total+')');
             
             (function( $ ) {
                function initMap( $el ) {
                var $markers = $el.find('.marker');
                var mapArgs = {
                zoom        : $el.data('zoom') || 25,
                mapTypeId   : google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map( $el[0], mapArgs );
                map.markers = [];
                $markers.each(function(){
                initMarker( $(this), map );
                });
                centerMap( map );
                return map;
                }
                function initMarker( $marker, map ) {
                var lat = $marker.data('lat');
                var lng = $marker.data('lng');
                // var
                var latLng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
                var icon = $marker.attr('data-icon');
                // create marker
                var marker = new google.maps.Marker({
                position : latLng,
                map: map,
                icon: icon
                });
                map.markers.push( marker );
                if( $marker.html() ){
                var infowindow = new google.maps.InfoWindow({
                content: $marker.html()
                });
                google.maps.event.addListener(marker, 'click', function() {infowindow.open( map, marker );});
                }
                }
                function centerMap( map ) {
                var bounds = new google.maps.LatLngBounds();
                map.markers.forEach(function( marker ){
                bounds.extend({
                lat: marker.position.lat(),
                lng: marker.position.lng()
                });
                });
                if( map.markers.length == 1 ){
                map.setCenter( bounds.getCenter() );
                } else{
                map.fitBounds( bounds );
                }
                }
                $(document).ready(function(){
                $('.acf-map').each(function(){
                var map = initMap( $(this) );
                });
                });
                })(jQuery);

          } else {
            jQuery(".host-result").html("<p class='error'>No result</p>");
            jQuery(".header-search-count").html('<h1>Hosts(0)</h1>');

          }

         }
      })        
  });
});
