Ext.define('sisscsj.model.objetivogeneral.ObjetivoGeneral', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_objetivo_general',
    fields: [
        // id field
        {
            name: 'id_objetivo_general',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_marco_logico',
            type: 'int',
            useNull: true
        },
        {
            name: 'descripcion_objetivo_general',
            type: 'string',
            useNull: true
        }
    ]
});