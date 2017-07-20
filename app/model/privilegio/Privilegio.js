Ext.define('sisscsj.model.privilegio.Privilegio', {
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
            name: 'valor_privilegio_usuario',
            type: 'int',
            useNull: true
        }
    ]
});
