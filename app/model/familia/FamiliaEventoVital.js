Ext.define('sisscsj.model.familia.FamiliaEventoVital', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_evento_vital_familia',
    fields: [
        // id field
        {
            name: 'id_evento_vital_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_evento_vital',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_evento_vital_familia',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'observaciones_evento_vital_familia',
            type: 'string',
            useNull: true
        }
    ]
});