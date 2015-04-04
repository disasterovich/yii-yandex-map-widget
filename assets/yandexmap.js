/*
 * Yandex map javascript widget
 * 
 * @author disasterovich@mail.ru
 * @site: diz-blog.com.ua
 * @ license: GPL
 * 
 * @var yandex_maps_markers - array()
 * @var yandex_maps_params - array()
 */

var infowindow;
var markers = [];

ymaps.ready(init);
var myMap;

function init()
    {
    myMap = new ymaps.Map("map-canvas", 
        {
        center: [yandex_maps_params['lat'], yandex_maps_params['lng']],
        zoom: yandex_maps_params['zoom'],
        controls: ['zoomControl'],   
        },
        {
        minZoom: yandex_maps_params['minzoom'],
        }
    );
    
    //Добавляем на карту маркеры со вслыв. окнами
    for (var i = 0; i < yandex_maps_markers.length; i++) 
        { createMarker(yandex_maps_markers[i]); }
        
    //Если маркер один и его перемещение разрешено, то сделаем его перемещаемым по двойному клику
    if ( yandex_maps_markers.length == 1 && yandex_maps_markers[0].draggable == true)
        {
        myMap.events.add('click', function (e) 
            {
            var position = e.get('coords');
            markers[0].geometry.setCoordinates(position);
            });
        }
    }
    
function createMarker(yandex_maps_marker) 
    {
    var marker = new ymaps.Placemark( [yandex_maps_marker['lat'], yandex_maps_marker['lng']], 
        {
        hintContent: yandex_maps_marker['title'],
        balloonContent: '<div class="popup_window"><img src="images/'+yandex_maps_marker['image']+'" />'+yandex_maps_marker['window_content']+'</div>',
        },
        {
        draggable: yandex_maps_marker['draggable'],
        }
        );
            
    myMap.geoObjects.add(marker);
        
    markers.push(marker);
    }
