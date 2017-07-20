Ext.define('sisscsj.model.usuario.UsuarioBeneficiario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_usuario_beneficiario',
    fields: [
        // id field
        {
            name: 'id_usuario_beneficiario',
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
            name: 'fk_id_gestion_beneficiario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_asignacion_usuario_beneficiario',
            type: 'date',
            useNull: true
        },
        {
            name: 'estado_usuario_beneficiario',
            type: 'int',
            useNull: true
        }
    ]
});