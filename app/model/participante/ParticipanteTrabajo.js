/**
 * Modelo que representa una actividad favorita
 */
Ext.define('sisscsj.model.participante.ParticipanteTrabajo', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_trabajo',
    fields: [
        // id field
        {
            name: 'id_beneficiario_trabajo',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        
        // campos simples
        {
            name: 'monto_ingreso_beneficiario_trabajo',
            type: 'int',
            useNull: true
        },
        {
            name: 'tipo_trabajo_beneficiario_trabajo',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_beneficiario_trabajo',
            type: 'int',
            useNull: true
        },
        {
            name: 'descripcion_beneficiario_trabajo',
            type: 'string',
            useNull: true
        }
    ]
});