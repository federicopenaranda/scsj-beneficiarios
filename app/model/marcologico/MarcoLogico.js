Ext.define('sisscsj.model.marcologico.MarcoLogico', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_marco_logico',
    fields: [
        // id field
        {
            name: 'id_marco_logico',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_marco_logico',
            type: 'date',
            useNull: true
        },
        {
            name: 'codigo_marco_logico',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_marco_logico',
            type: 'int',
            useNull: true
        },
        {
            name: 'observaciones_marco_logico',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_entidad',
            type: 'auto'
        }
    ]
});