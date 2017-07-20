Ext.define('sisscsj.model.gestion.Gestion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_gestion',
    fields: [
        {
            name: 'id_gestion',
            type: 'int',
            useNull: true
        },
        {
            name: 'estado_gestion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_gestion',
            type: 'string',
            useNull: true
        },
        {
            name: 'orden_gestion',
            type: 'int',
            useNull: true
        }
    ]
});
