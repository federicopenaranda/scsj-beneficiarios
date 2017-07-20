/**
 * Modelo que representa una actividad favorita
 */
Ext.define('sisscsj.model.participante.ParticipanteTelefono', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_telefono',
    fields: [
        // id field
        {
            name: 'id_beneficiario_telefono',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'numero_beneficiario_telefono',
            type: 'string',
            useNull: true
        },
        {
            name: 'tipo_telefono',
            type: 'string',
            useNull: true
        },
        {
            name: 'emergencia_beneficiario_telefono',
            type: 'int',
            useNull: true
        }
    ]
});