Ext.define('sisscsj.model.opciones.AreaActividad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_area_actividad',
    fields: [
        {
            name: 'id_area_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_area_actividad',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_area_actividad',
            type: 'string',
            useNull: true
        }
    ]
});
