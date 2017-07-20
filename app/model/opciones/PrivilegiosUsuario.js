Ext.define('sisscsj.model.opciones.PrivilegiosUsuario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_privilegios_usuario',
    fields: [
        {
            name: 'id_privilegios_usuario',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_privilegio_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'accion_privilegio_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'opciones_privilegio_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'funcion_privilegio_usuario',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_privilegios_usuario',
            type: 'string',
            useNull: true
        }
    ]
});
