Ext.define('sisscsj.model.opciones.TipoProblematica', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_problematica',
    fields: [
        {
            name: 'id_tipo_problematica',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_problematica',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_problematica',
            type: 'string',
            useNull: true
        }
    ]
});
