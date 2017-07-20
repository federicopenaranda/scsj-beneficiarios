Ext.define('sisscsj.model.opciones.Usuario', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_usuario',
    fields: [
        {
            name: 'id_usuario',
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
        }
    ]
});
