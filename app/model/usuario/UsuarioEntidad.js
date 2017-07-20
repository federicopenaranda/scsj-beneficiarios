Ext.define('sisscsj.model.usuario.UsuarioEntidad', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_usuario_entidad',
    fields: [
        // id field
        {
            name: 'id_usuario_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'fk_id_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'fecha_registro_usuario_entidad',
            type: 'date',
            useNull: true
        },
        {
            name: 'estado_usuario_entidad',
            type: 'int',
            useNull: true
        },
        {
            name: 'login_usuario',
            type: 'auto'
        },
        {
            name: 'nombre_entidad',
            type: 'auto'
        }
    ]
});