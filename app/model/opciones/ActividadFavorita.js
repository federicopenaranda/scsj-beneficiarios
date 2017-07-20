Ext.define('sisscsj.model.opciones.ActividadFavorita', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_actividad_favorita',
    fields: [
        {
            name: 'id_actividad_favorita',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_actividad_favorita',
            type: 'string',
            useNull: true
        }
    ]
});
