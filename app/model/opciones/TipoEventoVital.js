Ext.define('sisscsj.model.opciones.TipoEventoVital', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_evento_vital',
    fields: [
        {
            name: 'id_tipo_evento_vital',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_evento_vital',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_evento_vital',
            type: 'string',
            useNull: true
        }
    ]
});
