Ext.define('sisscsj.model.opciones.TipoUsuario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_tipo_usuario',
    fields: [
        {
            name: 'id_tipo_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_tipo_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_tipo_usuario',
            type: 'string',
            useNull: true
        }
    ]
});
