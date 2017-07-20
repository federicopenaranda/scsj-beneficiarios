Ext.define('sisscsj.model.participante.ParticipanteEstadoCivil', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_estado_civil',
    fields: [
        // id field
        {
            name: 'id_beneficiario_estado_civil',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_estado_civil',
            type: 'int',
            useNull: true
        },
        {
            name: 'estado_civil',
            type: 'string',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'estado_beneficiario_estado_civil',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_asignacion_beneficiario_estado_civil',
            type: 'date',
            useNull: true
        }
    ]
});