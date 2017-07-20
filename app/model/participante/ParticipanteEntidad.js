Ext.define('sisscsj.model.participante.ParticipanteEntidad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_entidad',
    fields: [
        // id field
        {
            name: 'id_beneficiario_entidad',
            type: 'int',
            useNull: true
        },
        // campos relacionados
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_entidad',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'fecha_vinculacion_beneficiario_entidad',
            type: 'date',
            useNull: true
        },
        {
            name: 'fecha_retiro_beneficiario_entidad',
            type: 'date',
            useNull: true
        },
        {
            name: 'razon_retiro_beneficiario',
            type: 'string',
            useNull: true
        },
        {
            name: 'estado_beneficiario_entidad',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_entidad',
            type: 'auto'
        }        
    ]
});