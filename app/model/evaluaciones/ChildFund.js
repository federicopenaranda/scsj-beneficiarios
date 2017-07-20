Ext.define('sisscsj.model.evaluaciones.ChildFund', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_childfund',
    fields: [
        // id field
        {
            name: 'id_childfund',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_tipo_consulta',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_childfund',
            type: 'string',
            useNull: true
        },
        {
            name: 'observaciones_childfund',
            type: 'string',
            useNull: true
        },
        {
            name: 'evaluacion_childfund',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_tipo_consulta',
            type: 'auto'
        },
        {
            name: 'nombre_usuario',
            type: 'auto'
        },
        {
            name: 'codigo_beneficiario',
            type: 'auto'
        }
    ]
});