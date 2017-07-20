Ext.define('sisscsj.model.opciones.SubAreaActividad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_sub_area',
    fields: [
        {
            name: 'id_sub_area',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_area_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_sub_area',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_sub_area',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_area_actividad',
            type: 'string'
        }
    ]
});
