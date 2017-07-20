Ext.define('sisscsj.model.familia.FamiliaTipoCasa', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_familia_tipo_casa',
    fields: [
        // id field
        {
            name: 'id_familia_tipo_casa',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_familia',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_cocina',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_casa',
            type: 'int',
            useNull: true
        },
        {
            name: 'observacion_familia_tipo_casa',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_familia_tipo_casa',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_registro_familia_tipo_casa',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'cuartos_multiuso_familia_tipo_casa',
            type: 'int',
            useNull: true
        },
        {
            name: 'ambientes_familia_tipo_casa',
            type: 'int',
            useNull: true
        }
    ]
});