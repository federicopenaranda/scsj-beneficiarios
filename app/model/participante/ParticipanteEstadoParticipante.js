Ext.define('sisscsj.model.participante.ParticipanteEstadoParticipante', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_estado_beneficiario',
    fields: [
        // id field
        {
            name: 'id_beneficiario_estado_beneficiario',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_estado_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario_tipo',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_edades_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_actor_beneficiario',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'fecha_asignacion_estado_beneficiario',
            type: 'date',
            useNull: true
        },
        {
            name: 'observaciones_beneficiario_estado_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'modalidad_estado_beneficiario',
            type: 'string',
            useNull: true
        }
    ]
});