Ext.define('sisscsj.model.usuario.Usuario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_usuario',
    fields: [
        // id field
        {
            name: 'id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_tipo_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'apellido_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'login_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'password_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'password_usuario2',
            type: 'string',
            useNull: true
        },
        {
            name: 'sexo_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'telefono_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'celular_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'correo_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'direccion_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'observacion_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'nombre_tipo_usuario',
            type: 'auto'
        },
        {
            name: 'usuario_lugar',
            type: 'auto'
        },
        {
            name: 'usuario_entidad',
            type: 'auto'
        },
        {
            name: 'usuario_beneficiario',
            type: 'auto'
        }
    ]
});