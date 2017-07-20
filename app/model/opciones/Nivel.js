Ext.define('sisscsj.model.opciones.Nivel', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_nivel',
    fields: [
        {
            name: 'id_nivel',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_nivel',
            type: 'string',
            useNull: true
        }
    ]
});
