Ext.define('sisscsj.model.opciones.Lugar', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_lugar_actividad',
    fields: [
        {
            name: 'id_lugar_actividad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_lugar',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_lugar_actividad',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_lugar_actividad',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_tipo_lugar',
            type: 'auto',
            persist: false
        }
    ]
});
