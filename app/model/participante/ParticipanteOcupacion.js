Ext.define('sisscsj.model.participante.ParticipanteOcupacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_beneficiario_ocupacion',
    fields: [
        // id field
        {
            name: 'id_beneficiario_ocupacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_ocupacion',
            type: 'int',
            useNull: true
        },
        // campos simples
        {
            name: 'fecha_beneficiario_ocupacion',
            type: 'date',
            dateFormat: 'Y-m-d',
            useNull: true
        },
        {
            name: 'estado_beneficiario_ocupacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'observacion_beneficiario_ocupacion',
            type: 'string',
            useNull: true
        }
    ]
});