Ext.define('sisscsj.model.opciones.Formacion', {
    extend: 'sisscsj.model.Base',
    idProperty: 'id_formacion',
    fields: [
        {
            name: 'id_formacion',
            type: 'int',
            useNull: true
        },
        {
            name: 'nombre_formacion',
            type: 'string',
            useNull: true
        },
        {
            name: 'descripcion_formacion',
            type: 'string',
            useNull: true
        }
    ]
});
