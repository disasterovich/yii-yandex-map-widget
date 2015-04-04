yii-yandex-map-widget
=====================

Простое расширение для создания карты yandex maps и установки на ней маркеров

Пример создания карты с одним неперемещаемым маркером:

```
$this->widget('ext.yii-yandex-map-widget-master.YandexMap',
    array
        (
        'markers' => array
            (
            array ( 
                'lat' => $latitude, 
                'lng' => $longitude, 
                'draggable'=>false, 
                'title'=>$item->name, 
                'window_content'=>$item->name,
                ),
            ),
        'params' => array
            (
            'lat' => $latitude, 
            'lng' => $longitude,
            'visible'=>true,
            'zoom'=>13,
            'class' => 'map-view-single'
            ),
        )
    );
```

Пример создания карты с множеством неперемещаемых маркеров:

```
foreach ($items as $item)
    {
    $markers[] = array
        ( 
        'id'=>$item->id,
        'lat' => $item->lat, 
        'lng' => $item->lng, 
        'draggable'=>false, 
        'title'=>$item->name, 
        'window_content'=>$item->name, 
        );
    }

$this->widget('ext.yii-yandex-map-widget-master.YandexMap',
    array
        (
        'markers' => $markers,
        'params' => array
            (
            'lat' => $latitude->value, 
            'lng' => $longitude->value,
            'visible' => true,
            'zoom' => 8,
            'class' => 'map-index'
            ),
        )
    );
```

Пример создания карты с одним перемещаемым маркером:

```
$this->widget('ext.yii-yandex-map-widget-master.YandexMap',
    array
        (
        'markers' => array
            (
            array
                (
                'lat' => $latitude,
                'lng' => $longitude,
                'draggable'=>true,
                'title'=>$model->name,
                'window_content'=>$model->name
                ),
            ),
        'params' => array
            (
            'lat' => $latitude, 
            'lng' => $longitude,
            'visible'=>true,
            'zoom'=>8,
            'class' => 'map-form'
            ),
        )
    );
```