Ext.define('sisscsj.model.objetivoespecifico.ObjetivoEspecifico', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_objetivo_especifico',
    fields: [
        // id field
        {
            name: 'id_objetivo_especifico',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_objetivo_general',
            type: 'int',
            useNull: true
        },
        {
            name: 'descripcion_objetivo_especifico',
            type: 'string',
            useNull: true
        },
        {
            name: 'metas_objetivo_especifico',
            type: 'string',
            useNull: true
        },
        {
            name: 'indicadores_objetivo_especifico',
            type: 'string',
            useNull: true
        },
        {
            name: 'medios_verificacion_objetivo_especifico',
            type: 'string',
            useNull: true
        },
        {
            name: 'supuestos_objetivo_especifico',
            type: 'string',
            useNull: true
        }
    ]
});