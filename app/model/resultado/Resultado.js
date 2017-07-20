Ext.define('sisscsj.model.resultado.Resultado', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_resultado',
    fields: [
        // id field
        {
            name: 'id_resultado',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_objetivo_especifico',
            type: 'int',
            useNull: true
        },
        {
            name: 'descripcion_resultado',
            type: 'string',
            useNull: true
        },
        {
            name: 'metas_resultado',
            type: 'string',
            useNull: true
        },
        {
            name: 'indicadores_resultado',
            type: 'string',
            useNull: true
        },
        {
            name: 'medios_verificacion_resultado',
            type: 'string',
            useNull: true
        },
        {
            name: 'supuestos_resultado',
            type: 'string',
            useNull: true
        }
    ]
});