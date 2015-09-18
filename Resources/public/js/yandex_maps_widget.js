var YandexMapsWidgetClass = function(id, parameters) {
    this.id         = id;
    this.lat_input  = document.getElementById(this.id +'_lat');
    this.lng_input  = document.getElementById(this.id +'_lng');
    this.center     = [ this.lat_input.value, this.lng_input.value ];
    this.parameters = parameters;
    this.ya_map     = null;
    this.placemark  = null;

    this._init();
};

YandexMapsWidgetClass.prototype._init = function() {
    var _this = this;

    ymaps.ready(function() {
        _this
            ._createMap()
            ._placeMark()
            ._bindEvents()
        ;
    });

    return this;
};

YandexMapsWidgetClass.prototype._createMap = function() {
    this.ya_map = new ymaps.Map(this.id, {
        type:     this.parameters.type,
        center:   this.center,
        zoom:     this.parameters.zoom,
        controls: this.parameters.controls
    });

    if (this.parameters.scrollZoom === false) {
        this.ya_map.behaviors.disable('scrollZoom');
    }

    return this;
};

YandexMapsWidgetClass.prototype._placeMark = function() {
    this.placemark = new ymaps.Placemark(this.center, {}, {
        draggable: true
    });

    this.ya_map.geoObjects.add(this.placemark);

    return this;
};

YandexMapsWidgetClass.prototype._bindEvents = function() {
    var _this = this;

    this.ya_map.events.add('click', function(e) {
        _this.placemark.geometry.setCoordinates(e.get('coords'));
        _this.placemark.events.fire('drag');
    });

    this.placemark.events.add('drag', function() {
        var coordinates = _this.placemark.geometry.getCoordinates();

        _this.lat_input.value = coordinates[0];
        _this.lng_input.value = coordinates[1];
    });

    return this;
};
