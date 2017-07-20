Ext.define('sisscsj.model.opciones.TipoEntidad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_entidad',
    fields: [
        {
            name: 'id_tipo_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_entidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_entidad',
            type: 'string',
            useNull: true
        }
    ]
});
